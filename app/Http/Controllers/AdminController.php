<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Beranda;
use App\Models\Berita;
use App\Models\Ekstra;
use App\Models\Galeri;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //Fungsi untuk halaman dashboard
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'jBs' => Beranda::where('visib_beranda', 'Tampilkan')->count(),
            'jBh' => Beranda::where('visib_beranda', 'Sembunyikan')->count(),
            'jPs' => Pegawai::where('visib_pegawai', 'Tampilkan')->count(),
            'jPh' => Pegawai::where('visib_pegawai', 'Sembunyikan')->count(),
            'jEs' => Ekstra::where('visib_ekstra', 'Tampilkan')->count(),
            'jEh' => Ekstra::where('visib_ekstra', 'Sembunyikan')->count(),
            'jGs' => Galeri::where('visib_galeri', 'Tampilkan')->count(),
            'jGh' => Galeri::where('visib_galeri', 'Sembunyikan')->count(),
            'jAs' => Artikel::where('visib_artikel', 'Tampilkan')->count(),
            'jAh' => Artikel::where('visib_artikel', 'Sembunyikan')->count(),
            'jBTs' => Berita::where('visib_berita', 'Tampilkan')->count(),
            'jBTh' => Berita::where('visib_berita', 'Sembunyikan')->count(),
        ];
        return view('pages.admin.v_dashboard', $data);
    }

    //Fungsi untuk halaman profil
    public function editProf()
    {
        $data = [
            'judul' => 'Akun Saya',
        ];
        return view('pages.admin.v_profil_edit', $data);
    }

    public function updateProf(Request $request)
    {
        $passProf = User::findOrFail(Auth::user()->id);

        if (password_verify($request->password, $passProf->password)) {
            // validate form
            $request->validate([
                'nama'         => 'required|max:45',
                'alamat'       => 'required|max:255',
                'jabatan'      => 'required|max:255',
                'telp'         => 'required|numeric|max_digits:13',
            ]);

            //get by ID
            $profil = User::findOrFail(Auth::user()->id);

            //update
            $profil->update([
                'nama'        => $request->nama,
                'alamat'      => $request->alamat,
                'jabatan'     => $request->jabatan,
                'telp'        => $request->telp,
                'modified_by' => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('admin.dash')->with(['successprof' => 'Informasi Akun Anda Berhasil Diperbarui!']);
        }else{
            return redirect()->route('prof.edit')->with(['passerror' => 'Password Anda Salah!']);
        }
    }

    public function editPass()
    {
        $data = [
            'judul' => 'Ganti Password Akun',
        ];
        return view('pages.admin.v_profil_editPass', $data);
    }

    public function updatePass(Request $request)
    {
        $passEdit = User::findOrFail(Auth::user()->id);

        if (password_verify($request->oldPass, $passEdit->password)) {
            // validate form
            $request->validate([
                'confirmPass'  => 'required|same:newPass',
            ]);

            //get by ID
            $profil = User::findOrFail(Auth::user()->id);

            $newPass = password_hash($request->newPass, PASSWORD_DEFAULT);

            //update
            $profil->update([
                'password'    => $newPass,
                'modified_by' => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('prof.edit.pass')->with(['success' => 'Password Akun Anda Berhasil Diperbarui!']);
        }else{
            return redirect()->route('prof.edit.pass')->with(['error' => 'Password Lama Anda Salah!']);
        }
    }
}
