@extends('layouts.main')

@section('container')

    @include('partials.search')

    <div class="list-group border-0">
        @foreach ($karyailmiahs as $karyailmiah)
            <p>{{ $karyailmiah->penulis ?? $karyailmiah->nama_pemegang}}, - {{ \Carbon\Carbon::parse($karyailmiah->created_at)->format('Y') }} <a href="karyailmiah/{{ $karyailmiah->slug }}" class="text-decoration-none">{{ $karyailmiah->judul ?? $karyailmiah->no_hki }}</a> {{ $karyailmiah->rumpun->nama ?? '' }}, Politeknik Piksi Ganesha</p>
        @endforeach
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">

            <!-- Tombol "Previous" -->
            <li class="page-item {{ $karyailmiahs->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $karyailmiahs->previousPageUrl() }}" aria-label="Previous">
                    <span class="sr-only">Previous</span>
                </a>
            </li>

            <!-- Tombol nomor halaman -->
            @for ($i = 1; $i <= $karyailmiahs->lastPage(); $i++)
                <li class="page-item {{ $karyailmiahs->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $karyailmiahs->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            <!-- Tombol "Next" -->
            <li class="page-item {{ $karyailmiahs->currentPage() == $karyailmiahs->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $karyailmiahs->nextPageUrl() }}" aria-label="Next">
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
@endsection
