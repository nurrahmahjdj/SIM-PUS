@extends('layouts.main')

@section('container')
    <p class="fs-4 mt-3">Postingan Saya</p>

    @if (session()->has('sukses'))
        <div class="alert alert-success fade show d-flex" role="alert">
            {{ session('sukses') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @foreach ($karyailmiahs as $karyailmiah)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row p-2">
                    <div class="col-xl-1 col-lg-2 col-sm-3">
                        <img src="/img/paper.png" class="pe-5">
                    </div>
                    <div class="col-xl-11 col-lg-10 col-sm-9">
                        <h5 class="card-title">{{ $karyailmiah->judul ?? 'HKI No. ' . $karyailmiah->no_hki }}</h5>
                        @if ($karyailmiah->status == 'Terverifikasi')
                            <p class="card-text text-success" title="status">Berhasil Diposting!</p>
                            <a href="/karyailmiah/{{ $karyailmiah->slug }}" class="card-link">lihat</a>
                        @elseif ($karyailmiah->status == 'Belum Terverifikasi')
                            <p class="card-text text-danger" title="status">Menunggu Verifikasi</p>
                        @elseif ($karyailmiah->status == 'Telah Diperbaiki')
                            <p class="card-text text-warning" title="status">Telah di perbaiki, Menunggu Verifikasi</p>
                        @else
                            <p class="card-text text-danger" title="status">Perlu Direvisi!</p>
                            <a href="/karyailmiah/{{ $karyailmiah->slug }}/edit" class="card-link">Edit</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
