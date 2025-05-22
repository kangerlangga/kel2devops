<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kontak;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Data Berita',
            'DataBerita' => Berita::latest()->get(),
        ];
        return view('pages.admin.v_berita', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'Tambahkan Berita',
        ];
        return view('pages.admin.v_berita_add', $data);
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
            'Isi'   => 'required',
        ]);

        //upload image
        $foto = $request->file('Foto');
        $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
        $foto->move('img/foto/berita', $fotoName);

        //create
        Berita::create([
            'id_berita'         => 'Berita'.Str::random(33),
            'id_detail'         => Str::random(19),
            'judul_berita'      => $request->Judul,
            'isi_berita'        => $request->Isi,
            'foto_berita'       => $fotoName,
            'visib_berita'      => $request->visibilitas,
            'penulis_berita'    => Auth::user()->nama,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('berita.tambah')->with(['success' => 'Berita Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beritaData = Berita::where('id_detail', $id)->where('visib_berita', 'Tampilkan')->firstOrFail();

        $beritaData->format_tgl = $this->formatTimestamp($beritaData->created_at);

        $data = [
            'judul' => $beritaData->judul_berita,
            'DetailBerita' => $beritaData,
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ];
        return view('pages.public.berita_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = [
            'judul' => 'Edit Berita',
            'EditBerita' => Berita::findOrFail($id),
        ];
        return view('pages.admin.v_berita_edit', $data);
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
            'Isi'   => 'required',
        ]);

        //get by ID
        $berita = Berita::findOrFail($id);

        //cek gambar di upload
        if ($request->hasFile('Foto')) {
            $berita_path = 'img/foto/berita/' . $berita->foto_berita;
            if (file_exists($berita_path)) {
                unlink($berita_path);
            }
            //upload image
            $foto = $request->file('Foto');
            $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
            $foto->move('img/foto/berita', $fotoName);

            //update
            $berita->update([
                'judul_berita'  => $request->Judul,
                'isi_berita'    => $request->Isi,
                'foto_berita'   => $fotoName,
                'visib_berita'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('berita.data')->with(['success' => 'Berita Berhasil Diperbarui!']);
        }else{
            //update
            $berita->update([
                'judul_berita'  => $request->Judul,
                'isi_berita'    => $request->Isi,
                'visib_berita'  => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('berita.data')->with(['success' => 'Berita Berhasil Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $berita = Berita::findOrFail($id);

        //delete image
        $berita_path = 'img/foto/berita/' . $berita->foto_berita;
        if (file_exists($berita_path)) {
            unlink($berita_path);
        }

        //delete
        $berita->delete();

        //redirect to index
        return redirect()->route('berita.data')->with(['success' => 'Berita Berhasil Dihapus!']);
    }

    private function formatTimestamp($timestamp)
    {
        $date = Carbon::parse($timestamp);

        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $dayName = $days[$date->format('l')];
        $monthName = $months[$date->format('F')];

        return $dayName . ', ' . $date->format('d') . ' ' . $monthName . ' ' . $date->format('Y') . ' | ' . $date->format('H:i') . ' WIB';
    }
}
