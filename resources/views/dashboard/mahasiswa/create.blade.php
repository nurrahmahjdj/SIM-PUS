@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom px-5">
    <h1 class="h2">Tambah Nama Mahasiswa</h1>
</div>

<div class="col-lg-8 px-5 mt-5">
    <form method="post" action="/dashboard/mahasiswa">
        @csrf
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm" name="npm" required autofocus value="{{ old('npm') }}" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;">
                @error('npm')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        <a href="/dashboard/mahasiswa" class="btn text-decoration-none" style="background-color: #DEBACE;">Kembali</a>
        <button type="submit" class="btn text-white ms-2" style="background-color: #7F669D;">Tambah</button>
    </form>
</div>

@endsection