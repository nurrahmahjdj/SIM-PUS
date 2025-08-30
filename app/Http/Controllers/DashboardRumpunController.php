<?php

namespace App\Http\Controllers;

use App\Models\Rumpun;
use Illuminate\Http\Request;

class DashboardRumpunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rumpun = Rumpun::all();

        return view('dashboard.rumpun.index', [
            'rumpuns' => $rumpun,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rumpun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedTipe = $request->validate([
            'nama' => 'required|unique:tipes',
        ]);

        Rumpun::create($validatedTipe);

        return redirect('dashboard/rumpun')->with('sukses', 'Rumpun baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rumpun  $rumpun
     * @return \Illuminate\Http\Response
     */
    public function show(Rumpun $rumpun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rumpun  $rumpun
     * @return \Illuminate\Http\Response
     */
    public function edit(Rumpun $rumpun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rumpun  $rumpun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rumpun $rumpun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rumpun  $rumpun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rumpun $rumpun)
    {
        Rumpun::destroy($rumpun->id);

        return redirect('dashboard/rumpun')->with('sukses', 'Rumpun berhasil dihapus!');
    }
}
