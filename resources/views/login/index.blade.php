@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">

        <div class="form-box">
            @if (session()->has('success'))
                <div class="alert alert-succes alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="Close"></button>
                </div>
            @endif



            <main class="form-signin w-100 my-4 m-auto d-grid">
                <form action="/login" method="post">
                    @csrf
                    <h1 class="h4 mb-3 fw-normal text-center">Repository </h1>
                    <h2 class="h4 mb-5 fw-normal text-center">Politeknik Piksi Ganesha </h2>

                    @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="Close"></button>
                </div>
            @endif
                    <div class="form-floating">
                        <input type="npm" name="npm" class="form-control @error('npm') is-invalid @enderror"
                            id="npm" placeholder="npm" autofocus required value="{{ old('npm') }}">
                        <label for="npm"><i class="bi bi-person-fill"></i></i>NPM</label>
                        @error('npm')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="Password" placeholder="Password"
                            required>
                        <label for="Password"><i class="bi bi-lock-fill"></i></i> Password</label>
                    </div>

                    {{-- <div class="form-check text-start my-3">
                        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            ingat saya
                        </label>
                    </div> --}}
                    <div class="d-grid mt-5">
                      <button class="btn btn-piksi" type="submit">Masuk</button>
                    </div>

                </form>

            </main>



        </div>

    </div>
@endsection
