<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Data Pegawai',
            'DataPegawai' => Pegawai::latest()->get(),
        ];
        return view('pages.admin.v_pegawai', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'Tambahkan Pegawai',
        ];
        return view('pages.admin.v_pegawai_add', $data);
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
            'Jabatan'   => 'required|max:255',
        ]);

        //upload image
        $foto = $request->file('Foto');
        $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
        $foto->move('img/foto/pegawai', $fotoName);

        //create
        Pegawai::create([
            'id_pegawai'        => 'Pegawai'.Str::random(33),
            'nama_pegawai'      => $request->Nama,
            'jabatan_pegawai'   => $request->Jabatan,
            'foto_pegawai'      => $fotoName,
            'visib_pegawai'     => $request->visibilitas,
            'created_by'    => Auth::user()->email,
            'modified_by'   => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('pegawai.tambah')->with(['success' => 'Pegawai Berhasil Ditambahkan!']);
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
            'judul' => 'Edit Informasi Pegawai',
            'EditPegawai' => Pegawai::findOrFail($id),
        ];
        return view('pages.admin.v_pegawai_edit', $data);
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
            'Jabatan'   => 'required|max:255',
        ]);

        //get by ID
        $pegawai = Pegawai::findOrFail($id);

        //cek gambar di upload
        if ($request->hasFile('Foto')) {
            $pegawai_path = 'img/foto/pegawai/' . $pegawai->foto_pegawai;
            if (file_exists($pegawai_path)) {
                unlink($pegawai_path);
            }
            //upload image
            $foto = $request->file('Foto');
            $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
            $foto->move('img/foto/pegawai', $fotoName);

            //update
            $pegawai->update([
                'nama_pegawai'      => $request->Nama,
                'jabatan_pegawai'   => $request->Jabatan,
                'foto_pegawai'      => $fotoName,
                'visib_pegawai'     => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('pegawai.data')->with(['success' => 'Pegawai Berhasil Diperbarui!']);
        }else{
            //update
            $pegawai->update([
                'nama_pegawai'      => $request->Nama,
                'jabatan_pegawai'   => $request->Jabatan,
                'visib_pegawai'     => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('pegawai.data')->with(['success' => 'Pegawai Berhasil Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $pegawai = Pegawai::findOrFail($id);

        //delete image
        $pegawai_path = 'img/foto/pegawai/' . $pegawai->foto_pegawai;
        if (file_exists($pegawai_path)) {
            unlink($pegawai_path);
        }

        //delete
        $pegawai->delete();

        //redirect to index
        return redirect()->route('pegawai.data')->with(['success' => 'Pegawai Berhasil Dihapus!']);
    }
}
