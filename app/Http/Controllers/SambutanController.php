<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sambutanData = Sambutan::latest()->limit(1)->get();

        $sambutanData->map(function ($item) {
            $item->update_tgl = $this->formatTimestamp($item->updated_at);
            return $item;
        });

        $data = [
            'judul' => 'Detail Sambutan',
            'jS' => Sambutan::count(),
            'Sambutan' => $sambutanData,
        ];
        return view('pages.admin.v_sambutan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request): View
    {
        $id = $request->input('id');
        $sambutan = Sambutan::find($id);
        if ($sambutan) {
            $data = [
                'judul' => 'Edit Sambutan Kepala Sekolah',
                'EditSambutan' => Sambutan::findOrFail($id),
            ];
            return view('pages.admin.v_sambutan_edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $sambutan = Sambutan::find($id);
        if ($sambutan) {
            // validate form
            $request->validate([
                'Nama'      => 'required|max:255',
                'Jabatan'   => 'required|max:255',
                'Foto'      => 'image|mimes:jpeg,jpg,png|max:3072',
                'Isi'       => 'required',
            ]);

            //get by ID
            $sambutan = Sambutan::findOrFail($id);

            //cek gambar di upload
            if ($request->hasFile('Foto')) {
                $sambutan_path = 'img/foto/sambutan/' . $sambutan->foto_sambutan;
                if (file_exists($sambutan_path)) {
                    unlink($sambutan_path);
                }
                //upload image
                $foto = $request->file('Foto');
                $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
                $foto->move('img/foto/sambutan', $fotoName);

                //update
                $sambutan->update([
                    'nama_sambutan'     => $request->Nama,
                    'jabatan_sambutan'  => $request->Jabatan,
                    'isi_sambutan'      => $request->Isi,
                    'foto_sambutan'     => $fotoName,
                    'visib_sambutan'    => $request->visibilitas,
                    'modified_by'       => Auth::user()->email,
                ]);

                //redirect to index
                return redirect()->route('sambutan.data')->with(['success' => 'Sambutan Berhasil Diperbarui!']);
            }else{
                //update
                $sambutan->update([
                    'nama_sambutan'     => $request->Nama,
                    'jabatan_sambutan'  => $request->Jabatan,
                    'isi_sambutan'      => $request->Isi,
                    'visib_sambutan'    => $request->visibilitas,
                    'modified_by'       => Auth::user()->email,
                ]);

                //redirect to index
                return redirect()->route('sambutan.data')->with(['success' => 'Sambutan Berhasil Diperbarui!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
