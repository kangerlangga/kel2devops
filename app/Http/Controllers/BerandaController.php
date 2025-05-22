<?php

namespace App\Http\Controllers;

use App\Models\Beranda;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Data Beranda',
            'DataBeranda' => Beranda::latest()->get(),
        ];
        return view('pages.admin.v_beranda', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'Tambah Foto Beranda',
        ];
        return view('pages.admin.v_beranda_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Foto'          => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'Judul'         => 'required|max:255',
            'Deskripsi'     => 'required|max:255',
            'Detail'        => 'required|max:255|url',
        ]);

        //upload image
        $foto = $request->file('Foto');
        $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
        $foto->move('img/foto/beranda', $fotoName);

        //create
        Beranda::create([
            'id_beranda'     => 'Beranda'.Str::random(33),
            'judul_beranda'  => $request->Judul,
            'desk_beranda'   => $request->Deskripsi,
            'foto_beranda'   => $fotoName,
            'link_beranda'   => $request->Detail,
            'visib_beranda'  => $request->visibilitas,
            'created_by'    => Auth::user()->email,
            'modified_by'   => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('beranda.tambah')->with(['success' => 'Beranda Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = [
            'judul' => 'Edit Informasi Beranda',
            'EditBeranda' => Beranda::findOrFail($id),
        ];
        return view('pages.admin.v_beranda_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // validate form
        $request->validate([
            'Foto'          => 'image|mimes:jpeg,jpg,png|max:3072',
            'Judul'         => 'required|max:255',
            'Deskripsi'     => 'required|max:255',
            'Detail'        => 'required|max:255|url',
        ]);

        //get by ID
        $beranda = Beranda::findOrFail($id);

        //cek gambar di upload
        if ($request->hasFile('Foto')) {
            $beranda_path = 'img/foto/beranda/' . $beranda->foto_beranda;
            if (file_exists($beranda_path)) {
                unlink($beranda_path);
            }
            //upload image
            $foto = $request->file('Foto');
            $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
            $foto->move('img/foto/beranda', $fotoName);

            //update
            $beranda->update([
                'judul_beranda'  => $request->Judul,
                'desk_beranda'   => $request->Deskripsi,
                'foto_beranda'   => $fotoName,
                'link_beranda'   => $request->Detail,
                'visib_beranda'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('beranda.data')->with(['success' => 'Beranda Berhasil Diperbarui!']);
        }else{
            //update
            $beranda->update([
                'judul_beranda'  => $request->Judul,
                'desk_beranda'   => $request->Deskripsi,
                'link_beranda'   => $request->Detail,
                'visib_beranda'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('beranda.data')->with(['success' => 'Beranda Berhasil Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $beranda = Beranda::findOrFail($id);

        //delete image
        $beranda_path = 'img/foto/beranda/' . $beranda->foto_beranda;
        if (file_exists($beranda_path)) {
            unlink($beranda_path);
        }

        //delete
        $beranda->delete();

        //redirect to index
        return redirect()->route('beranda.data')->with(['success' => 'Beranda Berhasil Dihapus!']);
    }
}
