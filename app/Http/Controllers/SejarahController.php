<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sejarahData = Sejarah::latest()->limit(1)->get();

        $sejarahData->map(function ($item) {
            $item->update_tgl = $this->formatTimestamp($item->updated_at);
            return $item;
        });

        $data = [
            'judul' => 'Detail Sejarah',
            'jS' => Sejarah::count(),
            'Sejarah' => $sejarahData,
        ];
        return view('pages.admin.v_sejarah', $data);
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
        $sejarah = Sejarah::find($id);
        if ($sejarah) {
            $data = [
                'judul' => 'Edit Sejarah',
                'EditSejarah' => Sejarah::findOrFail($id),
            ];
            return view('pages.admin.v_sejarah_edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $id = $request->input('id');
        $sejarah = Sejarah::find($id);
        if ($sejarah) {
            // validate form
            $request->validate([
                'Foto'          => 'image|mimes:jpeg,jpg,png|max:3072',
                'Detail'        => 'required',
            ]);

            //get by ID
            $sejarah = Sejarah::findOrFail($id);

            //cek gambar di upload
            if ($request->hasFile('Foto')) {
                $sejarah_path = 'img/foto/sejarah/' . $sejarah->foto_sejarah;
                if (file_exists($sejarah_path)) {
                    unlink($sejarah_path);
                }
                //upload image
                $foto = $request->file('Foto');
                $fotoName = time().Str::random(17).'.'.$foto->getClientOriginalExtension();
                $foto->move('img/foto/sejarah', $fotoName);

                //update
                $sejarah->update([
                    'detail_sejarah' => $request->Detail,
                    'foto_sejarah'   => $fotoName,
                    'visib_sejarah'  => $request->visibilitas,
                    'modified_by'   => Auth::user()->email,
                ]);

                //redirect to index
                return redirect()->route('sejarah.data')->with(['success' => 'Sejarah Berhasil Diperbarui!']);
            }else{
                //update
                $sejarah->update([
                    'detail_sejarah' => $request->Detail,
                    'visib_sejarah'  => $request->visibilitas,
                    'modified_by'   => Auth::user()->email,
                ]);

                //redirect to index
                return redirect()->route('sejarah.data')->with(['success' => 'Sejarah Berhasil Diperbarui!']);
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
