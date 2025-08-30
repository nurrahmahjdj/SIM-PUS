<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $notif = false;
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        return view('user.resetpass', [
            'karyailmiahs' => KaryaIlmiah::where('user_id', auth()->user()->id)->get(),
            'title' => 'Karya Ilmiah',
            'notif' => $notif,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $validatedData = $request->validate([
            'password' => 'required|max:225|current_password',
            'password_baru' => 'required|max:225',
            'konfirmasi_password' => 'required|max:225|same:password_baru',
        ]);

        $password_baru['password']=bcrypt($validatedData['password_baru']);
        
        Mahasiswa::where('id', $user->id)
                ->update($password_baru);

        return back()->with('success', 'Password berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

    public function post()
    {
        $notif = false;
        if (auth()->user()) {
            $notif = KaryaIlmiah::where('user_id', auth()->user()->id)->get()->contains('status', 'Perbaikan');
        }

        return view('user.post', [
            'karyailmiahs' => KaryaIlmiah::where('user_id', auth()->user()->id)->get(),
            'title' => 'Karya Ilmiah',
            'notif' => $notif,
        ]);

    }
}
