@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-3 border-bottom px-4">
        <p class="h2">Rumpun Mahasiswa</p>
    </div>

    @if (session()->has('sukses'))
        <div class="alert alert-success fade show d-flex" role="alert">
            {{ session('sukses') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-lg-8 px-5">
        <a href="/dashboard/rumpun/create" class="btn btn-piksi text-decoration-none my-3">Tambah Rumpun</a>
        <table class="table table-striped table-sm table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Rumpun</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rumpuns as $rumpun)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $rumpun->nama }}</td>
                        <td>
                            <form action="/dashboard/rumpun/{{ $rumpun->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')" title="Hapus Rumpun"><i
                                        class="bi bi-x-circle"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
