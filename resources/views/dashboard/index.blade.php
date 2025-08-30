@extends('dashboard.layouts.main')

@section('container')
 <div class="container-fluid px-4">
    <h1 class="my-4 mb-5">Halaman Admin</h1>


    <div class="row px-5">

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4" style="background-color: #7F669D;">
                <div class="card-body text-white ">
                    <h4>USER</h4>
                    <h5>{{ $users }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white fs-6 stretched link" href="/dashboard/mahasiswa">Lihat Detail</a>
                    <div class="small text-white"><i class="bi bi-chevron-right "></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4" style="background-color: #967fa5;">
                <div class="card-body text-white">
                    <h4>JURNAL</h4>
                    <h5>{{ $jurnal }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white fs-6 stretched link" href="/dashboard/karyailmiah?tipe=Jurnal">Lihat Detail</a>
                    <div class="small text-white"><i class="bi bi-chevron-right "></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4" style="background-color: #BA94D1;">
                <div class="card-body text-white">
                    <h4>SKRIPSI</h4>
                    <h5>{{ $skripsi }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white fs-6 stretched link" href="/dashboard/karyailmiah?tipe=Skripsi+%2F+Tugas+Akhir">Lihat Detail</a>
                    <div class="small text-white"><i class="bi bi-chevron-right "></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4" style="background-color: #DEBACE;">
                <div class="card-body text-white">
                    <h4>HAKI</h4>
                    <h5>{{ $haki }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white fs-6 stretched link" href="/dashboard/karyailmiah?tipe=HKI">Lihat Detail</a>
                    <div class="small text-white"><i class="bi bi-chevron-right "></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4" style="background-color: #F2BED1;">
                    <div class="card-body text-white">
                      <p class="h4 mb-1 text-center">Jumlah Pengunjung</p>
                      <hr style="position: relative;">
                      <h2 class="mt-1 h5 text-center">{{ $visitorCount }}</h2>
                    </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mb-4" style="background-color: #F2BED1;">
                    <div class="card-body text-white">
                      <p class="h4 mb-1 text-center">Pengunjung Bulan Ini</p>
                      <hr style="position: relative;">
                      <h2 class="mt-1 h5 text-center">{{ $visitorCount }}</h2>
                    </div>
            </div>
        </div>

    </div>
    <div class="container px-5 mx-auto">
        <div class="p-6 m-20 bg-white rounded shadow">
            {!! $visitorcountchart->container() !!}
        </div>
    </div>

    <script src="{{ $visitorcountchart->cdn() }}"></script>
    {{ $visitorcountchart->script() }}

</div>
@endsection
