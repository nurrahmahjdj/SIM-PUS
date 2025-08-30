@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 border-bottom px-4">
        <p class="h2">Halaman Karya Ilmiah</p>
    </div>

    @if (session()->has('sukses'))
        <div class="alert alert-success fade show d-flex" role="alert">
            {{ session('sukses') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center px-5">
        <form class="row g-3 pb-4" action="/dashboard/karyailmiah">
            <div class="col-md-2">
                <select class="form-select shadow-sm border-0 fst-italic" name="tipe">
                    <option selected value="">Tipe</option>
                    @foreach ($tipes as $tipe)
                        @if (request('tipe') == $tipe->tipe)
                            <option value="{{ $tipe->tipe }}" selected>{{ $tipe->tipe }}</option>
                        @else
                            <option value="{{ $tipe->tipe }}">{{ $tipe->tipe }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select shadow-sm border-0 fst-italic" name="rumpun">
                    <option selected value="">Rumpun</option>
                    @foreach ($rumpuns as $rumpun)
                        @if (request('rumpun') == $rumpun->nama)
                            <option value="{{ $rumpun->nama }}" selected>{{ $rumpun->nama }}</option>
                        @else
                            <option value="{{ $rumpun->nama }}">{{ $rumpun->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control shadow-sm border-0 fst-italic"
                    value="@if (request('subjek')) {{ request('subjek') }} @endif" placeholder="Judul"
                    name="subjek">
            </div>
            <div class="col-md-3">
                <select class="form-select shadow-sm border-0 fst-italic" name="status">
                    <option selected value="">Status</option>
                    @foreach ($status as $s)
                        @if (request('status') == $s->status)
                            <option value="{{ $s->status }}" selected>{{ $s->status }}</option>
                        @else
                            <option value="{{ $s->status }}">{{ $s->status }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button class="btn shadow-sm" type="submit" style="background-color: #E9DFEA"><i class="bi bi-search text-white"></i></button>
            </div>
        </form>
    </div>

    <div class="table-responsive px-5">
        <table class="table table-striped table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">NPM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Rumpun</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-truncate">
                @foreach ($karyailmiahs as $karyailmiah)
                    <tr>
                        <td>{{ $karyailmiah->user->npm }}</td>
                        <td>{{ $karyailmiah->user->name }}</td>
                        <td>{{ $karyailmiah->tipe }}</td>
                        <td>{{ $karyailmiah->rumpun->nama ?? '-' }}</td>
                        <td class="text-wrap">{{ $karyailmiah->judul ?? $karyailmiah->no_hki }}</td>                        <td class=
                            @if ($karyailmiah->status == 'Belum Terverifikasi')
                                "bg-danger"
                            @elseif ($karyailmiah->status == 'Telah Diperbaiki')
                                "bg-warning"
                                @endif>
                            {{ $karyailmiah->status }}</td>
                        <td class="text-center">
                            <a href="/dashboard/karyailmiah/{{ $karyailmiah->slug }}/edit" class='badge bg-primary'
                                title="Edit Status"><i class="bi bi-eye"></i></span></a>
                            <form action="/dashboard/karyailmiah/{{ $karyailmiah->slug }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"
                                    title="Hapus Karya Ilmiah"><i class="bi bi-x-circle"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <nav aria-label="Page navigation" class="align-self-end">
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
    </div>
@endsection
