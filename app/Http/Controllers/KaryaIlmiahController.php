<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiah;
use App\Models\Rumpun;
use App\Models\Prodi;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class KaryaIlmiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyailmiahs = KaryaIlmiah::where('status', 'Terverifikasi')->filter(request(['tahun', 'subjek', 'rumpun', 'penulis', 'tipe']))->paginate(10)->withQueryString();
        $rumpun = Rumpun::all();
        $notif = false;
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        $tahun = DB::table('karya_ilmiahs')
            ->select(DB::raw('YEAR(created_at) as tahun'))
            ->distinct()
            ->get();

        return view('karyailmiah.index', [
            'karyailmiahs' => $karyailmiahs,
            'rumpuns' => $rumpun,
            'title' => 'Karya Ilmiah',
            'tahuns' => $tahun,
            'notif' => $notif,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->check()) {
            abort(403);
        }
        $tipe = ['Jurnal', 'Skripsi / Tugas Akhir', 'HKI'];
        $rumpun = Rumpun::all();
        $prodi = Prodi::all();
        $prodi_id = Prodi::distinct()->get(['rumpun_id']);
        $notif = false;
        $jenis_ciptaan = ['Produk', 'Buku', 'Karya Ilmiah'];
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        return view('karyailmiah.create', [
            'title' => 'Karya Ilmiah',
            'tipes' => $tipe,
            'rumpuns' => $rumpun,
            'prodis' => $prodi,
            'jenis_ciptaans' => $jenis_ciptaan,
            'notif' => $notif,
            'prodi_id' => $prodi_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->tipe == 'Skripsi / Tugas Akhir') {
            global $validateKaryaIlmiah;
            $validateKaryaIlmiah = $request->validate([
                'tipe' => 'required|max:255',
                'rumpun_id' => 'required|max:255',
                'prodi_id' => 'required|max:255',
                'judul' => 'required|max:255',
                'slug' => 'required|unique:karya_ilmiahs|max:255',
                'kata_kunci' => 'required|max:255',
                'penulis' => 'required|max:255',
                'referensi' => 'required|max:5000',
                'abstrak' => 'required|max:2000',
                'cover' => 'required|file|max:2048',
                'file_abstrak' => 'required|file|max:2048',
                'daftar_isi' => 'required|file|max:2048',
                'bab_i' => 'required|file|max:2048',
                'bab_ii' => 'required|file|max:2048',
                'bab_iii' => 'required|file|max:2048',
                'bab_iv' => 'required|file|max:2048',
                'bab_v' => 'file|max:2048',
                'daftar_pustaka' => 'required|file|max:2048',
            ]);
        } elseif ($request->tipe == 'Jurnal') {
            global $validateKaryaIlmiah;
            $validateKaryaIlmiah = $request->validate([
                'tipe' => 'required|max:255',
                'rumpun_id' => 'required|max:255',
                'prodi_id' => 'required|max:255',
                'judul' => 'required|max:255',
                'slug' => 'required|unique:karya_ilmiahs|max:255',
                'kata_kunci' => 'required|max:255',
                'penulis' => 'required|max:255',
                'nama_jurnal' => 'required|max:255',
                'tautan_laman' => 'required|max:255',
                'tanggal_terbit' => 'required|max:255',
                'volume' => 'required|max:255',
                'nomor' => 'required|max:255',
                'halaman' => 'required|max:255',
                'penerbit' => 'required|max:255',
                'doi' => 'required|max:255',
                'issn' => 'required|max:255',
                'referensi' => 'required|max:5000',
                'abstrak' => 'required|max:2000',
                'file_jurnal' => 'required|file|max:2048',
            ]);
        } elseif ($request->tipe == 'HKI') {
            global $validateKaryaIlmiah;
            $validateKaryaIlmiah = $request->validate([
                'tipe' => 'required|max:255',
                'judul' => 'required|max:255',
                'no_hki' => 'required|max:255',
                'tanggal_permohonan' => 'required|max:255',
                'nama_pemegang' => 'required|max:255',
                'slug' => 'required|unique:karya_ilmiahs|max:255',
                'jenis_ciptaan' => 'required|max:255',
                'sertifikat' => 'required|file|max:512',
            ]);
        };

        if ($request->file('cover')) {
            $validateKaryaIlmiah['cover'] = $request->file('cover')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('file_abstrak')) {
            $validateKaryaIlmiah['file_abstrak'] = $request->file('file_abstrak')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('daftar_isi')) {
            $validateKaryaIlmiah['daftar_isi'] = $request->file('daftar_isi')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_i')) {
            $validateKaryaIlmiah['bab_i'] = $request->file('bab_i')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_ii')) {
            $validateKaryaIlmiah['bab_ii'] = $request->file('bab_ii')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_iii')) {
            $validateKaryaIlmiah['bab_iii'] = $request->file('bab_iii')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_iv')) {
            $validateKaryaIlmiah['bab_iv'] = $request->file('bab_iv')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_v')) {
            $validateKaryaIlmiah['bab_v'] = $request->file('bab_v')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('daftar_pustaka')) {
            $validateKaryaIlmiah['daftar_pustaka'] = $request->file('daftar_pustaka')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('file_jurnal')) {
            $validateKaryaIlmiah['file_jurnal'] = $request->file('file_jurnal')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('sertifikat')) {
            $validateKaryaIlmiah['sertifikat'] = $request->file('sertifikat')->store('karyailmiah/' . auth()->user()->npm);
        }

        $validateKaryaIlmiah['user_id'] = auth()->user()->id;

        KaryaIlmiah::create($validateKaryaIlmiah);

        return redirect('user/post')->with('sukses', $request->tipe . ' berhasil terkirim!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function show(KaryaIlmiah $karyailmiah)
    {
        $notif = false;
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        return view('karyailmiah.show', [
            'karyailmiah' => $karyailmiah,
            'title' => 'Karya Ilmiah',
            'notif' => $notif,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function edit(KaryaIlmiah $karyailmiah)
    {
        if (!auth()->check() || auth()->user()->id !== $karyailmiah->user_id) {
            abort(403);
        }
        $tipe = ['Jurnal', 'Skripsi / Tugas Akhir', 'HKI'];
        $rumpun = Rumpun::all();
        $prodi = Prodi::all();
        $prodi_id = Prodi::distinct()->get(['rumpun_id']);
        $jenis_ciptaan = ['Produk', 'Buku', 'Karya Ilmiah'];
        $notif = false;
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        return view('karyailmiah.edit', [
            'karyailmiah' => $karyailmiah,
            'title' => 'Karya Ilmiah',
            'tipes' => $tipe,
            'rumpuns' => $rumpun,
            'notif' => $notif,
            'jenis_ciptaans' => $jenis_ciptaan,
            'prodis' => $prodi,
            'prodi_id' => $prodi_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KaryaIlmiah  $karyaIlmiah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KaryaIlmiah $karyailmiah)
    {
        if($karyailmiah->tipe == 'Skripsi / Tugas Akhir') {
            global $rules;
            $rules = [
                'rumpun_id' => 'required|max:255',
                'prodi_id' => 'required|max:255',
                'judul' => 'required|max:255',
                'kata_kunci' => 'required|max:255',
                'penulis' => 'required|max:255',
                'referensi' => 'required|max:255',
                'abstrak' => 'required|max:2000',
                'cover' => 'file|max:2048',
                'file_abstrak' => 'file|max:2048',
                'daftar_isi' => 'file|max:2048',
                'bab_i' => 'file|max:2048',
                'bab_ii' => 'file|max:2048',
                'bab_iii' => 'file|max:2048',
                'bab_iv' => 'file|max:2048',
                'bab_v' => 'file|max:2048',
                'daftar_pustaka' => 'file|max:2048',
            ];
        } elseif ($karyailmiah->tipe == 'Jurnal') {
            global $rules;
            $rules = [
                'rumpun_id' => 'required|max:255',
                'prodi_id' => 'required|max:255',
                'judul' => 'required|max:255',
                'kata_kunci' => 'required|max:255',
                'penulis' => 'required|max:255',
                'nama_jurnal' => 'required|max:255',
                'tautan_laman' => 'required|max:255',
                'tanggal_terbit' => 'required|max:255',
                'volume' => 'required|max:255',
                'nomor' => 'required|max:255',
                'halaman' => 'required|max:255',
                'penerbit' => 'required|max:255',
                'doi' => 'required|max:255',
                'issn' => 'required|max:255',
                'referensi' => 'required|max:255',
                'abstrak' => 'required|max:2000',
                'file_jurnal' => 'file|max:2048',
            ];
        } elseif ($karyailmiah->tipe == 'HKI') {
            global $rules;
            $rules = [
                'no_hki' => 'required|max:255',
                'judul' => 'required|max:255',
                'tanggal_permohonan' => 'required|max:255',
                'nama_pemegang' => 'required|max:255',
                'slug' => 'required|unique:karya_ilmiahs|max:255',
                'jenis_ciptaan' => 'required|max:255',
                'sertifikat' => 'file|max:512',
            ];
        };

        if ($request->slug != $karyailmiah->slug) {
            $rules['slug'] = 'required|unique:karya_ilmiahs|max:255';
        }

        $validateKaryaIlmiah = $request->validate($rules);

        if ($request->file('cover')) {
            if ($karyailmiah->cover) {
                Storage::delete($karyailmiah->cover);
            }
            $validateKaryaIlmiah['cover'] = $request->file('cover')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('file_abstrak')) {
            if ($karyailmiah->file_abstrak) {
                Storage::delete($karyailmiah->file_abstrak);
            }
            $validateKaryaIlmiah['file_abstrak'] = $request->file('file_abstrak')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('daftar_isi')) {
            if ($karyailmiah->daftar_isi) {
                Storage::delete($karyailmiah->daftar_isi);
            }
            $validateKaryaIlmiah['daftar_isi'] = $request->file('daftar_isi')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_i')) {
            if ($karyailmiah->bab_i) {
                Storage::delete($karyailmiah->bab_i);
            }
            $validateKaryaIlmiah['bab_i'] = $request->file('bab_i')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_ii')) {
            if ($karyailmiah->bab_ii) {
                Storage::delete($karyailmiah->bab_ii);
            }
            $validateKaryaIlmiah['bab_ii'] = $request->file('bab_ii')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_iii')) {
            if ($karyailmiah->bab_iii) {
                Storage::delete($karyailmiah->bab_iii);
            }
            $validateKaryaIlmiah['bab_iii'] = $request->file('bab_iii')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_iv')) {
            if ($karyailmiah->bab_iv) {
                Storage::delete($karyailmiah->bab_iv);
            }
            $validateKaryaIlmiah['bab_iv'] = $request->file('bab_iv')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('bab_v')) {
            if ($karyailmiah->bab_v) {
                Storage::delete($karyailmiah->bab_v);
            }
            $validateKaryaIlmiah['bab_v'] = $request->file('bab_v')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('daftar_pustaka')) {
            if ($karyailmiah->daftar_pustaka) {
                Storage::delete($karyailmiah->daftar_pustaka);
            }
            $validateKaryaIlmiah['daftar_pustaka'] = $request->file('daftar_pustaka')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('file_jurnal')) {
            if ($karyailmiah->file_jurnal) {
                Storage::delete($karyailmiah->file_jurnal);
            }
            $validateKaryaIlmiah['file_jurnal'] = $request->file('file_jurnal')->store('karyailmiah/' . auth()->user()->npm);
        }
        if ($request->file('sertifikat')) {
            if ($karyailmiah->sertifikat) {
                Storage::delete($karyailmiah->sertifikat);
            }
            $validateKaryaIlmiah['sertifikat'] = $request->file('sertifikat')->store('karyailmiah/' . auth()->user()->npm);
        }

        $validateKaryaIlmiah['status'] = 'Telah Diperbaiki';

        KaryaIlmiah::where('id', $karyailmiah->id)
            ->update($validateKaryaIlmiah);

        return redirect('/user/post')->with('sukses', 'Karya ilmiah berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KaryaIlmiah  $karyailmiah
     * @return \Illuminate\Http\Response
     */
    public function destroy(KaryaIlmiah $karyailmiah)
    {
        //
    }

    public function home()
    {
        $jurnals = KaryaIlmiah::latest()->where('status', 'Terverifikasi')->where('tipe', 'Jurnal')->limit(3)->get();
        $skripsis = KaryaIlmiah::latest()->where('status', 'Terverifikasi')->where('tipe', 'Skripsi / Tugas Akhir')->limit(3)->get();
        $hkis = KaryaIlmiah::latest()->where('status', 'Terverifikasi')->where('tipe', 'HKI')->limit(3)->get();
        $rumpun = Rumpun::all();
        $notif = false;
        $visitorCount = Visitor::count();
        $month = Carbon::now()->addMonth(0)->format('m');
        $visitorCountMonth = Visitor::where(DB::raw('MONTH(visited_at)'), $month)->count();

        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        $tahun = DB::table('karya_ilmiahs')
            ->select(DB::raw('YEAR(created_at) as tahun'))
            ->distinct()
            ->get();

        return view('home', [
            'rumpuns' => $rumpun,
            'title' => 'Home',
            'tahuns' => $tahun,
            'notif' => $notif,
            'jurnals' => $jurnals,
            'skripsis' => $skripsis,
            'hkis' => $hkis,
            'visitorCount' => $visitorCount,
            'visitorCountMonths' => $visitorCountMonth,
        ]);
    }

    public function about()
    {
        $notif = false;
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        return view('about', [
            'title' => 'Tentang Kami',
            'notif' => $notif,
        ]);
    }
}
