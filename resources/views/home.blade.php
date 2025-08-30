@extends('layouts.main')

@section('container')
<div class="mt-2 mb-2">
    <img src="/img/hero1.png" class="img-fluid float-start p-0 m-0 mb-2" style="position: relative">
  </div>

    @include('partials.search')

    <h5 class="py-3 text-center">Karya Ilmiah yang Baru dirilis</h5>
    <div class="list-group py-3">
        <p class="h4 mb-0">Jurnal</p>
        <hr>
        @foreach ($jurnals as $karyailmiah)
            <p>{{ $karyailmiah->penulis }}, - {{ \Carbon\Carbon::parse($karyailmiah->published_at)->format('Y') }} <a
                    href="karyailmiah/{{ $karyailmiah->slug }}" class="text-decoration-none">{{ $karyailmiah->judul }}</a>
                {{ $karyailmiah->rumpun->nama }}, Politeknik Piksi Ganesha</p>
        @endforeach
    </div>
    <div class="list-group py-3">
        <p class="h4 mb-0">Skripsi / Tugas Akhir</p>
        <hr>
        @foreach ($skripsis as $karyailmiah)
            <p>{{ $karyailmiah->penulis }}, - {{ \Carbon\Carbon::parse($karyailmiah->published_at)->format('Y') }} <a
                    href="karyailmiah/{{ $karyailmiah->slug }}" class="text-decoration-none">{{ $karyailmiah->judul }}</a>
                {{ $karyailmiah->rumpun->nama }}, Politeknik Piksi Ganesha</p>
        @endforeach
    </div>
    <div class="list-group py-3 mb-4">
        <p class="h4 mb-0">HKI</p>
        <hr>
        @foreach ($hkis as $karyailmiah)
            <p>{{ $karyailmiah->nama_pemegang }}, - {{ \Carbon\Carbon::parse($karyailmiah->published_at)->format('Y') }} <a
                    href="karyailmiah/{{ $karyailmiah->slug }}" class="text-decoration-none">{{ $karyailmiah->judul }}</a>, Politeknik Piksi Ganesha</p>
        @endforeach
    </div>

    <div class="shadow card-group w-50">
        <div class="card">
          <div class="card-body ">
            <p class="h4 mb-1 text-center">Jumlah Pengunjung</p>
            <hr style="position: relative;">
            <h2 class="mt-1 text-center">{{ $visitorCount }}</h2>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <p class="h4 mb-1 text-center">Pengunjung Bulan Ini</p>
            <hr style="position: relative;">
            <h2 class="mt-1 text-center">{{ $visitorCount }}</h2>
          </div>
        </div>
      </div>
    </div>
@endsection
