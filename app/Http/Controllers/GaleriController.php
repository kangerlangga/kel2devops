<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Data Galeri',
            'DataGaleri' => Galeri::latest()->get(),
        ];
        return view('pages.admin.v_galeri', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'Tambahkan Galeri',
        ];
        return view('pages.admin.v_galeri_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Foto'  => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'Judul' => 'required|max:255',
            'Desk'  => 'required|max:255',
        ]);

        //upload image
        $foto = $request->file('Foto');
        $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
        $foto->move('img/foto/galeri', $fotoName);

        //create
        Galeri::create([
            'id_galeri'     => 'Galeri'.Str::random(33),
            'judul_galeri'  => $request->Judul,
            'desk_galeri'   => $request->Desk,
            'foto_galeri'   => $fotoName,
            'visib_galeri'  => $request->visibilitas,
            'created_by'    => Auth::user()->email,
            'modified_by'   => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('galeri.tambah')->with(['success' => 'Galeri Berhasil Ditambahkan!']);
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
            'judul' => 'Edit Informasi Galeri',
            'EditGaleri' => Galeri::findOrFail($id),
        ];
        return view('pages.admin.v_galeri_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // validate form
        $request->validate([
            'Foto'  => 'image|mimes:jpeg,jpg,png|max:3072',
            'Judul' => 'required|max:255',
            'Desk'  => 'required|max:255',
        ]);

        //get by ID
        $galeri = Galeri::findOrFail($id);

        //cek gambar di upload
        if ($request->hasFile('Foto')) {
            $galeri_path = 'img/foto/galeri/' . $galeri->foto_galeri;
            if (file_exists($galeri_path)) {
                unlink($galeri_path);
            }
            //upload image
            $foto = $request->file('Foto');
            $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
            $foto->move('img/foto/galeri', $fotoName);

            //update
            $galeri->update([
                'judul_galeri'  => $request->Judul,
                'desk_galeri'   => $request->Desk,
                'foto_galeri'   => $fotoName,
                'visib_galeri'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('galeri.data')->with(['success' => 'Galeri Berhasil Diperbarui!']);
        }else{
            //update
            $galeri->update([
                'judul_galeri'  => $request->Judul,
                'desk_galeri'   => $request->Desk,
                'visib_galeri'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('galeri.data')->with(['success' => 'Galeri Berhasil Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $galeri = Galeri::findOrFail($id);

        //delete image
        $galeri_path = 'img/foto/galeri/' . $galeri->foto_galeri;
        if (file_exists($galeri_path)) {
            unlink($galeri_path);
        }

        //delete
        $galeri->delete();

        //redirect to index
        return redirect()->route('galeri.data')->with(['success' => 'Galeri Berhasil Dihapus!']);
    }
}
