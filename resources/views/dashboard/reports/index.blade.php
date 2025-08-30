@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 border-bottom px-4">
        <p class="h2">Halaman Reports</p>
    </div>


    <div class="row pb-5 px-5">

        <form method="get" action="/dashboard/reports" class="row" onload="tampilFile()">
            <div class="col-md-2 mt-5">
                <label> Start Date: </label>
                <input type="date" name="start_date" class="form-control shadow-sm" value="{{ old('start_date', date('Y-m-d')) }}">
            </div>

            <div class="col-md-2 mt-5">
                <label> End Date: </label>
                <input type="date" name="end_date" class="form-control shadow-sm" value="{{ old('end_date', date('Y-m-d')) }}">
            </div>

            <div class="col-md-2 mt-5">
                <label> Tipe </label>
                <select class="form-select shadow-sm" name="tipe">
                    <option selected disabled value="">Pilih Tipe</option>
                @foreach ($tipes as $tipe)
                    @if (request('tipe') == $tipe->tipe)
                        <option value="{{ $tipe->tipe }}" selected>{{ $tipe->tipe }}</option>
                    @else
                        <option value="{{ $tipe->tipe }}">{{ $tipe->tipe }}</option>
                    @endif
                @endforeach
                </select>
            </div>

            <div class="col-md-2 mt-5">
                <label> Rumpun </label>
                <select class="form-select shadow-sm" name="rumpun">
                    <option selected disabled value="">Pilih Rumpun</option>
                @foreach ($rumpuns as $rumpun)
                    @if (request('rumpun') == $rumpun->nama)
                        <option value="{{ $rumpun->nama }}" selected>{{ $rumpun->nama }}</option>
                    @else
                        <option value="{{ $rumpun->nama }}">{{ $rumpun->nama }}</option>
                    @endif
                @endforeach
                </select>
            </div>

            {{-- //Jurusan// --}}
            {{-- <div class="col-md-2 mt-5">
                <label> Prodi </label>
                <select class="form-select shadow-sm border-0" name="prodi">
                    <option selected disabled value="">Pilih Jurusan</option>
                @foreach ($prodis as $prodi)
                    @if (request('prodi') == $prodi->nama)
                        <option value="{{ $prodi->nama }}" selected>{{ $prodi->nama }}</option>
                    @else
                        <option value="{{ $prodi->nama }}">{{ $prodi->nama }}</option>
                    @endif
                @endforeach
                </select>
            </div> --}}

            <div class="col-auto pt-4 mt-5">
                <button class="btn shadow-sm text-white" type="submit" style="background-color: #7F669D;">Filter</button>
            </div>
            <div class="col-auto pt-4 mt-5">
                <a href="http://127.0.0.1:8000/dashboard/reports" class="btn shadow-sm text-white"  style="background-color: #DEBACE;">Reset</a>
            </div>
        </form>


        <div class="col-auto pt-4 mt-5">
            <a href="/exportpdf" class="btn text-white shadow" style="background-color: #85586F;">Export PDF</a>
        </div>
    </div>

    <div class="table-responsive px-5">
    <table class="table table-striped table-sm table-bordered text-right ">
        <thead>
            <tr>
                <th scope="col">Tipe</th>
                <th scope="col">Judul/No HKI</th>
                <th scope="col">Rumpun</th>
                <th scope="col">Tanggal Terbit</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($karyailmiahs as $karyailmiah)
                <tr>
                    <td>{{ $karyailmiah->tipe }}</td>
                    <td>{{ $karyailmiah->judul ?? $karyailmiah->no_hki }}</td>
                    <td>{{ $karyailmiah->rumpun->nama ?? '-' }}</td>
                    <td>{{ $karyailmiah->created_at }}</td>
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
