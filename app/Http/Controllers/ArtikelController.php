<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kontak;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'judul' => 'Data Artikel',
            'DataArtikel' => Artikel::latest()->get(),
        ];
        return view('pages.admin.v_artikel', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'Tambahkan Artikel',
        ];
        return view('pages.admin.v_artikel_add', $data);
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
        $foto->move('img/foto/artikel', $fotoName);

        //create
        Artikel::create([
            'id_artikel'        => 'Artikel'.Str::random(33),
            'id_detail'         => Str::random(19),
            'judul_artikel'     => $request->Judul,
            'isi_artikel'       => $request->Isi,
            'foto_artikel'      => $fotoName,
            'visib_artikel'     => $request->visibilitas,
            'penulis_artikel'   => Auth::user()->nama,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('artikel.tambah')->with(['success' => 'Artikel Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikelData = Artikel::where('id_detail', $id)->where('visib_artikel', 'Tampilkan')->firstOrFail();

        $artikelData->format_tgl = $this->formatTimestamp($artikelData->created_at);

        $data = [
            'judul' => $artikelData->judul_artikel,
            'DetailArtikel' => $artikelData,
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ];
        return view('pages.public.artikel_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = [
            'judul' => 'Edit Artikel',
            'EditArtikel' => Artikel::findOrFail($id),
        ];
        return view('pages.admin.v_artikel_edit', $data);
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
        $artikel = Artikel::findOrFail($id);

        //cek gambar di upload
        if ($request->hasFile('Foto')) {
            $artikel_path = 'img/foto/artikel/' . $artikel->foto_artikel;
            if (file_exists($artikel_path)) {
                unlink($artikel_path);
            }
            //upload image
            $foto = $request->file('Foto');
            $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
            $foto->move('img/foto/artikel', $fotoName);

            //update
            $artikel->update([
                'judul_artikel' => $request->Judul,
                'isi_artikel'   => $request->Isi,
                'foto_artikel'  => $fotoName,
                'visib_artikel' => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('artikel.data')->with(['success' => 'Artikel Berhasil Diperbarui!']);
        }else{
            //update
            $artikel->update([
                'judul_artikel' => $request->Judul,
                'isi_artikel'   => $request->Isi,
                'visib_artikel' => $request->visibilitas,
                'modified_by'   => Auth::user()->email,
            ]);

            //redirect to index
            return redirect()->route('artikel.data')->with(['success' => 'Artikel Berhasil Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $artikel = Artikel::findOrFail($id);

        //delete image
        $artikel_path = 'img/foto/artikel/' . $artikel->foto_artikel;
        if (file_exists($artikel_path)) {
            unlink($artikel_path);
        }

        //delete
        $artikel->delete();

        //redirect to index
        return redirect()->route('artikel.data')->with(['success' => 'Artikel Berhasil Dihapus!']);
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
