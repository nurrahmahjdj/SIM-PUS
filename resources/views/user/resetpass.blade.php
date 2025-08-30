@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Reset Password</h1>
</div>
<p class="fw-bold mt-4 text-center">Buat Kata Sandi yang Kuat</p>
<p class="fs-6 text-center">Kata sandi baru harus terdiri dari minimal 6 karakter dengan menggunakan kombinasi huruf dan angka</p>


@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="container text-center mt-5" style="display: flex; justify-content: center;">
    <form class="row row-cols-1" action="/user/{{  auth()->user()->id }}" method="post" style="width: 500px">
        @method('put')
        @csrf
                <div class="col mb-3">
                    <div class="form-floating text-secondary">
                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingInputGroup1" placeholder="masukan password awal">
                        <label for="floatingInputGroup1">masukan password awal</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="form-floating text-secondary">
                        <input type="text" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru" id="floatingInputGroup1" placeholder="masukan password baru">
                        <label for="floatingInputGroup1">masukan password baru</label>
                        @error('password_baru')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="form-floating text-secondary">
                        <input type="text" class="form-control @error('konfirmasi_password') is-invalid @enderror " name="konfirmasi_password" id="floatingInputGroup1" placeholder="masukan password baru">
                        <label for="floatingInputGroup1">masukan password baru</label>
                        @error('konfirmasi_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark border-0 btn-masuk my-2 my-sm-0 py-2" style="background-color: #905E96;">Ganti Kata Sandi </button>
                </div>
    </form>
</div>

@endsection