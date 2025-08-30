@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom px-5">
        <h1 class="h2">Tambah Rumpun Mahasiswa</h1>
    </div>
    <div class="col-lg-8 px-5 mt-5">
        <form class="row g-3" method="POST" action="/dashboard/rumpun" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="nama" class="form-label">Nama Rumpun</label>
                <input type="text" value="{{ old('nama') }}" name="nama"
                    class="form-control  @error('nama') is-invalid @enderror" id="nama" placeholder="Rumpun" autofocus>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="justify-content-end float-end align-items-end text-right mt-4">
                <a href="/dashboard/rumpun" class="btn text-white" style="background-color: #BA94D1 ;">Kembali</a>
                <button type="submit" class="btn text-white ms-2" style="background-color: #7F669D;">Submit</button>
                <button type="reset" class="btn text-white ms-2" style="background-color: #DEBACE;">Bersihkan Form</button>
            </div>
        </form>
    </div>
@endsection
