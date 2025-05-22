<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Data Ekstrakurikuler',
            'DataEkstra' => Ekstra::latest()->get(),
        ];
        return view('pages.admin.v_ekstra', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'Tambahkan Ekstrakurikuler',
        ];
        return view('pages.admin.v_ekstra_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Foto'      => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'Nama'      => 'required|max:255',
            'Detail'    => 'required',
        ]);

        //upload image
        $foto = $request->file('Foto');
        $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
        $foto->move('img/foto/ekstra', $fotoName);

        //create
        Ekstra::create([
            'id_ekstra'     => 'Ekstra'.Str::random(33),
            'id_detail'     => Str::random(9),
            'nama_ekstra'   => $request->Nama,
            'detail_ekstra' => $request->Detail,
            'foto_ekstra'   => $fotoName,
            'visib_ekstra'  => $request->visibilitas,
            'created_by'    => Auth::user()->email,
            'modified_by'   => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('ekstra.tambah')->with(['success' => 'Ekstrakurikuler Berhasil Ditambahkan!']);
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
            'judul' => 'Edit Informasi Ekstrakurikuler',
            'EditEkstra' => Ekstra::findOrFail($id),
        ];
        return view('pages.admin.v_ekstra_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // validate form
        $request->validate([
            'Foto'      => 'image|mimes:jpeg,jpg,png|max:3072',
            'Nama'      => 'required|max:255',
            'Detail'    => 'required',
        ]);

        //get by ID
        $ekstra = Ekstra::findOrFail($id);

        //cek gambar di upload
        if ($request->hasFile('Foto')) {
            $ekstra_path = 'img/foto/ekstra/' . $ekstra->foto_ekstra;
            if (file_exists($ekstra_path)) {
                unlink($ekstra_path);
            }
            //upload image
            $foto = $request->file('Foto');
            $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
            $foto->move('img/foto/ekstra', $fotoName);

            //update
            $ekstra->update([
                'nama_ekstra'   => $request->Nama,
                'detail_ekstra' => $request->Detail,
                'foto_ekstra'   => $fotoName,
                'visib_ekstra'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('ekstra.data')->with(['success' => 'Ekstrakurikuler Berhasil Diperbarui!']);
        }else{
            //update
            $ekstra->update([
                'nama_ekstra'   => $request->Nama,
                'detail_ekstra' => $request->Detail,
                'visib_ekstra'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('ekstra.data')->with(['success' => 'Ekstrakurikuler Berhasil Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $ekstra = Ekstra::findOrFail($id);

        //delete image
        $ekstra_path = 'img/foto/ekstra/' . $ekstra->foto_ekstra;
        if (file_exists($ekstra_path)) {
            unlink($ekstra_path);
        }

        //delete
        $ekstra->delete();

        //redirect to index
        return redirect()->route('ekstra.data')->with(['success' => 'Ekstrakurikuler Berhasil Dihapus!']);
    }
}
