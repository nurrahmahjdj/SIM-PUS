<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiah;
use App\Models\Rumpun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardKaryaIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyailmiahs = KaryaIlmiah::latest()->filter(request(['subjek', 'rumpun', 'status', 'tipe']))->paginate(15)->withQueryString();
        $rumpuns = Rumpun::all();

        $tipes = KaryaIlmiah::distinct()->get(['tipe']);
        $status = KaryaIlmiah::distinct()->get(['status']);

        return view('dashboard.karyailmiah.index', [
            'karyailmiahs' => $karyailmiahs,
            'tipes' => $tipes,
            'rumpuns' => $rumpuns,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function show(KaryaIlmiah $karyailmiah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function edit(KaryaIlmiah $karyailmiah)
    {
        return view('dashboard.karyailmiah.edit', [
            'karyailmiah' => $karyailmiah,
            'status' => ['Belum Terverifikasi', 'Telah Diperbaiki', 'Perbaikan', 'Terverifikasi']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KaryaIlmiah  $karyailmiah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KaryaIlmiah $karyailmiah)
    {
        if($request->status == 'Perbaikan') {
            global $validatedKaryaIlmiah;
            $validatedKaryaIlmiah = $request->validate([
                'status' => 'required|max:255',
                'catatan' => 'required|max:255',
            ]);
        } elseif ($request->status == 'Terverifikasi') {
            global $validatedKaryaIlmiah;
            $validatedKaryaIlmiah = $request->validate([
                'status' => 'required|max:255',
            ]);

            $validatedKaryaIlmiah['catatan'] = '';
        } else {
            $request->validate([
                'status' => 'required|max:255',
            ]);
        }

        KaryaIlmiah::where('id', $karyailmiah->id)
            ->update($validatedKaryaIlmiah);

        return redirect('/dashboard/karyailmiah')->with('sukses', 'Status karya ilmiah berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KaryaIlmiah  $karyailmiah
     * @return \Illuminate\Http\Response
     */
    public function destroy(KaryaIlmiah $karyailmiah)
    {
        if ($karyailmiah->cover ||
        $karyailmiah->lembar_pengesahan ||
        $karyailmiah->file_abstrak ||
        $karyailmiah->daftar_isi ||
        $karyailmiah->bab_i ||
        $karyailmiah->bab_ii ||
        $karyailmiah->bab_iii ||
        $karyailmiah->bab_iv ||
        $karyailmiah->bab_v ||
        $karyailmiah->kesimpulan ||
        $karyailmiah->daftar_pustaka ||
        $karyailmiah->sertifikat){
            Storage::deleteDirectory('karyailmiah/' . $karyailmiah->user->npm);
        }
        KaryaIlmiah::destroy($karyailmiah->id);

        return redirect('dashboard/karyailmiah')->with('sukses', 'Karya Ilmiah berhasil dihapus!');
    }
}
