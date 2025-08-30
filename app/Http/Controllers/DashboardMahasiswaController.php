<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mahasiswas = Mahasiswa::latest()->filter(request(['search']))->paginate(15)->withQueryString();

        return view('dashboard.mahasiswa.index',[
            "mahasiswas" => $mahasiswas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'npm' => 'required|unique:users',
            'name' => 'required|max:225',
        ]);

        $validatedData['password']= bcrypt($request->npm);

        Mahasiswa::create($validatedData);

        return redirect('dashboard/mahasiswa')->with('success', 'User baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('dashboard.mahasiswa.edit', [
            'mahasiswa'=> $mahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:225',
        ]);

        Mahasiswa::where('id', $mahasiswa->id)
                ->update($validatedData);

        return redirect('dashboard/mahasiswa')->with('success', 'User berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::destroy($mahasiswa->id);

        return redirect('dashboard/mahasiswa')->with('success', 'user berhasil dihapus!');
    }

    public function reset(Request $request, $npm)
    {
        $validatedData['password']= bcrypt($npm);

        Mahasiswa::where('npm', $npm)
        ->update($validatedData);

        return redirect('dashboard/mahasiswa')->with('success', 'password berhasil direset!');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namefile = $data->getClientOriginalName();
        $data->move('UserData', $namefile);

        Excel::import(new UsersImport, \public_path('/UserData/'.$namefile));

        return redirect('dashboard/mahasiswa')->with('success', 'Data Mahasiswa Berhasil di Import!');
    }
}
