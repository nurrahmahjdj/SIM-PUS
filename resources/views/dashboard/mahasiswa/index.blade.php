@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom px-4">
  <h1 class="h2">Mahasiswa Piksi Ganesha</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="col-lg-10 p-3 px-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="/dashboard/mahasiswa" method="get" class="d-flex my-3" role="search">
          <input class="form-control me-2" type="text" placeholder="Search..." name="search" value="{{ request('search') }}">
          <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>

    <a href="/dashboard/mahasiswa/create" class="btn text-decoration-none my-3 text-white" style="background-color: #BA94D1;">Tambah Mahasiswa</a>

    <!-- Button trigger modal -->
    <button type="button" class="btn text-white ms-3" style="background-color: #967fa5;" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Import Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Mahasiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> 
          <form action="/importexcel" method="POST" enctype="multipart/form-data">
          @csrf
        
          <div class="modal-body">
            <div class="form-group">
              <input type="file" name="file" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn text-white" style="background-color: #DEBACE;" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn text-white ms-2" style="background-color: #7F669D;">Simpan</button>
          </div>
        </div>
      </form>
      </div>
    </div>

  <table class="table table-striped table-sm table-bordered text-right">
    <thead>
      <tr>
        <th scope="col">NO</th>
        <th scope="col">NPM</th>
        <th scope="col">Nama</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($mahasiswas as $mahasiswa)
      <tr>
        <th>{{ $loop->iteration + $mahasiswas->firstItem() - 1}}</th>
        <td>{{ $mahasiswa->npm }}</td>
        <td>{{ $mahasiswa->name }}</td>
        <td> 
          <a href="/dashboard/mahasiswa/{{ $mahasiswa->id }}/edit"class='badge bg-warning'><span data-feather="edit"></span></a>
          <form action="/dashboard/mahasiswa/{{ $mahasiswa->id }}" class="d-inline" method="post">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0"
                  onclick="return confirm('Apakah anda yakin?')"><span data-feather="x-circle">
              </button>
          </form>
          <form action="/dashboard/mahasiswa/{{ $mahasiswa->npm }}" class="d-inline" method="post">
            @csrf
            <button class="badge bg-primary border-0" onclick="return confirm('Apakah anda yakin?')">
              <span data-feather="key">
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
<br>
        Current Page: {{ $mahasiswas->currentPage() }}<br>
        Jumlah Data: {{ $mahasiswas->total() }}<br>
        Data perhalaman: {{ $mahasiswas->perPage() }}<br>
{{ $mahasiswas->onEachSide(2)->links() }}
</div>
@endsection