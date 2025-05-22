<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Beranda;
use App\Models\Berita;
use App\Models\Ekstra;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Pegawai;
use App\Models\Sambutan;
use App\Models\Sejarah;
use Carbon\Carbon;

class PublikController extends Controller
{
    //Fungsi untuk halaman beranda
    public function beranda()
    {
        return view('pages.public.beranda', [
            'judul' => 'Beranda',
            'jB' => Beranda::where('visib_beranda', 'Tampilkan')->count(),
            'Beranda' => Beranda::where('visib_beranda', 'Tampilkan')->latest()->get(),
            'jG' => Galeri::where('visib_galeri', 'Tampilkan')->count(),
            'Galeri' => Galeri::where('visib_galeri', 'Tampilkan')->latest()->limit(3)->get(),
            'jS' => Sejarah::where('visib_sejarah', 'Tampilkan')->count(),
            'Sejarah' => Sejarah::where('visib_sejarah', 'Tampilkan')->latest()->limit(1)->get(),
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman sejarah
    public function sejarah()
    {
        return view('pages.public.sejarah', [
            'judul' => 'Sejarah',
            'jS' => Sejarah::where('visib_sejarah', 'Tampilkan')->count(),
            'Sejarah' => Sejarah::where('visib_sejarah', 'Tampilkan')->latest()->limit(1)->get(),
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman sambutan
    public function sambutan()
    {
        return view('pages.public.sambutan', [
            'judul' => 'Sambutan Kepala Sekolah',
            'jS' => Sambutan::where('visib_sambutan', 'Tampilkan')->count(),
            'Sambutan' => Sambutan::where('visib_sambutan', 'Tampilkan')->latest()->limit(1)->get(),
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman pegawai
    public function pegawai()
    {
        return view('pages.public.pegawai', [
            'judul' => 'Daftar Guru dan Pegawai',
            'jP' => Pegawai::where('visib_pegawai', 'Tampilkan')->count(),
            'Pegawai' => Pegawai::where('visib_pegawai', 'Tampilkan')->latest()->get(),
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman ekstra
    public function ekstra()
    {
        return view('pages.public.ekstra', [
            'judul' => 'Ektrakurikuler',
            'jE' => Ekstra::where('visib_ekstra', 'Tampilkan')->count(),
            'Ekstra' => Ekstra::where('visib_ekstra', 'Tampilkan')->latest()->get(),
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman galeri
    public function galeri()
    {
        return view('pages.public.galeri', [
            'judul' => 'Galeri',
            'jG' => Galeri::where('visib_galeri', 'Tampilkan')->count(),
            'Galeri' => Galeri::where('visib_galeri', 'Tampilkan')->latest()->get(),
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman artikel
    public function artikel()
    {
         $artikelData = Artikel::where('visib_artikel', 'Tampilkan')->latest()->get();

         $artikelData->map(function ($item) {
             $item->format_tgl = $this->formatTimestamp($item->created_at);
             return $item;
         });

        return view('pages.public.artikel', [
            'judul' => 'Artikel',
            'jA' => Artikel::where('visib_artikel', 'Tampilkan')->count(),
            'Artikel' => $artikelData,
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman berita
    public function berita()
    {
        $beritaData = Berita::where('visib_berita', 'Tampilkan')->latest()->get();

        $beritaData->map(function ($item) {
            $item->format_tgl = $this->formatTimestamp($item->created_at);
            return $item;
        });
        return view('pages.public.berita', [
            'judul' => 'Berita',
            'jB' => Berita::where('visib_berita', 'Tampilkan')->count(),
            'Berita' => $beritaData,
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
    }

    //Fungsi untuk halaman kontak
    public function kontak()
    {
        return view('pages.public.kontak', [
            'judul' => 'Kontak',
            'jK' => Kontak::where('visib_kontak', 'Tampilkan')->count(),
            'Kontak' => Kontak::where('visib_kontak', 'Tampilkan')->latest()->limit(1)->get(),
        ]);
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
