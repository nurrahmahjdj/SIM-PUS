@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-8">
            <h3 class="fst-italic py-2">
                {{ $karyailmiah->judul ?? $karyailmiah->no_hki }}
            </h3>

            <div class="container-fluid my-4">
                <img src="/img/user/user.png" alt="User" width="30" class="me-2">
                {{ $karyailmiah->user->name }}
            </div>

            @if ($karyailmiah->abstrak)
                <article class="blog-post" style="text-align: justify">
                    <h5 class="link-body-emphasis my-3 text-center">Abstrak</h5>
                    <p style="text-align: justify">
                        {!! $karyailmiah->abstrak !!}
                    </p>
                </article>
            @endif
            @if ($karyailmiah->referensi)
                <p class="fw-bold">Referensi : {{ $karyailmiah->referensi }}</p>
            @endif
        </div>

        <div class="col-lg-4 px-5">
            <div class="position-sticky" style="top: 2rem;">
                <table class="table" style="border-color: transparent">
                    <tr>
                        <td scope="row">Tipe Item</td>
                        <td>: {{ $karyailmiah->tipe }}</td>
                    </tr>
                    @if ($karyailmiah->judul)
                        <tr>
                            <td scope="row">Judul</td>
                            <td>: {{ $karyailmiah->judul }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->rumpun_id)
                        <tr>
                            <td scope="row">Rumpun</td>
                            <td>: {{ $karyailmiah->rumpun->nama }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->prodi_id)
                        <tr>
                            <td scope="row">Prodi</td>
                            <td>: {{ $karyailmiah->prodi->nama }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->kata_kunci)
                        <tr>
                            <td scope="row">Kata Kunci</td>
                            <td>: {{ $karyailmiah->kata_kunci }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->penulis)
                        <tr>
                            <td scope="row">Penulis</td>
                            <td>: {{ $karyailmiah->penulis }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->nama_jurnal)
                        <tr>
                            <td scope="row">Nama Jurnal</td>
                            <td>: <a href="//{{ $karyailmiah->tautan_laman }}"
                                    target="_blank">{{ $karyailmiah->nama_jurnal }}</a></td>
                        </tr>
                    @endif
                    @if ($karyailmiah->tanggal_terbit)
                        <tr>
                            <td scope="row">Tanggal Terbit</td>
                            <td>: {{ $karyailmiah->tanggal_terbit }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->volume)
                        <tr>
                            <td scope="row">Volume</td>
                            <td>: {{ $karyailmiah->volume }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->nomor)
                        <tr>
                            <td scope="row">Nomor</td>
                            <td>: {{ $karyailmiah->nomor }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->halaman)
                        <tr>
                            <td scope="row">Halaman</td>
                            <td>: {{ $karyailmiah->halaman }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->penerbit)
                        <tr>
                            <td scope="row">Penerbit</td>
                            <td>: {{ $karyailmiah->penerbit }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->doi)
                        <tr>
                            <td scope="row">DOI</td>
                            <td>: {{ $karyailmiah->doi }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->issn)
                        <tr>
                            <td scope="row">ISSN</td>
                            <td>: {{ $karyailmiah->issn }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->no_hki)
                        <tr>
                            <td scope="row">No HKI</td>
                            <td>: {{ $karyailmiah->no_hki }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->tanggal_permohonan)
                        <tr>
                            <td scope="row">Tanggal Permohonan</td>
                            <td>: {{ $karyailmiah->tanggal_permohonan }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->nama_pemegang)
                        <tr>
                            <td scope="row">Nama Pemegang</td>
                            <td>: {{ $karyailmiah->nama_pemegang }}</td>
                        </tr>
                    @endif
                    @if ($karyailmiah->jenis_ciptaan)
                        <tr>
                            <td scope="row">Jenis Ciptaan</td>
                            <td>: {{ $karyailmiah->jenis_ciptaan }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td scope="row">Tanggal Upload</td>
                        <td>: {{ \Carbon\Carbon::parse($karyailmiah->created_at)->format('Y-m-d') }}</td>
                    </tr>
                </table>

                @if ($karyailmiah->cover)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>Cover</span>
                            <a href="{{ asset('storage/' . $karyailmiah->cover) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->file_abstrak)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>Abstrak</span>
                            <a href="{{ asset('storage/' . $karyailmiah->file_abstrak) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->daftar_isi)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>Daftar Isi</span>
                            <a href="{{ asset('storage/' . $karyailmiah->daftar_isi) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->bab_i)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>BAB I</span>
                            <a href="{{ asset('storage/' . $karyailmiah->bab_i) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->bab_ii)
                    @if (auth()->user())
                        <div class="row py-3">
                            <div class="col-4">
                                <img src="/img/doc/doc.png" alt="Document">
                            </div>
                            <div class="col-8 row">
                                <span>BAB II</span>
                                <a href="{{ asset('storage/' . $karyailmiah->bab_ii) }}" target="_blank">Download</a>
                            </div>
                        </div>
                    @else
                        <div class="row py-3">
                            <div class="col-4" style="position: relative;">
                                <img src="/img/doc/ban.png" alt="Banned"
                                    style="position: absolute;  top: 13px; left: 30px;">
                                <img src="/img/doc/doc.png" alt="Document">
                            </div>
                            <div class="col-8 row">
                                <span>BAB II</span>
                                <a href="/login" class="link-secondary">Download</a>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($karyailmiah->bab_iii)
                    @if (auth()->user())
                        <div class="row py-3">
                            <div class="col-4">
                                <img src="/img/doc/doc.png" alt="Document">
                            </div>
                            <div class="col-8 row">
                                <span>BAB III</span>
                                <a href="{{ asset('storage/' . $karyailmiah->bab_iii) }}" target="_blank">Download</a>
                            </div>
                        </div>
                    @else
                        <div class="row py-3">
                            <div class="col-4" style="position: relative;">
                                <img src="/img/doc/ban.png" alt="Banned"
                                    style="position: absolute;  top: 13px; left: 30px;">
                                <img src="/img/doc/doc.png" alt="Document">
                            </div>
                            <div class="col-8 row">
                                <span>BAB III</span>
                                <a href="/login" class="link-secondary">Download</a>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($karyailmiah->bab_iv)
                    @if (auth()->user())
                        <div class="row py-3">
                            <div class="col-4">
                                <img src="/img/doc/doc.png" alt="Document">
                            </div>
                            <div class="col-8 row">
                                <span>BAB IV</span>
                                <a href="{{ asset('storage/' . $karyailmiah->bab_iv) }}" target="_blank">Download</a>
                            </div>
                        </div>
                    @else
                        <div class="row py-3">
                            <div class="col-4" style="position: relative;">
                                <img src="/img/doc/ban.png" alt="Banned"
                                    style="position: absolute;  top: 13px; left: 30px;">
                                <img src="/img/doc/doc.png" alt="Document">
                            </div>
                            <div class="col-8 row">
                                <span>BAB IV</span>
                                <a href="/login" class="link-secondary">Download</a>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($karyailmiah->bab_v)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>BAB V</span>
                            <a href="{{ asset('storage/' . $karyailmiah->bab_v) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->daftar_pustaka)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>Daftar Pustaka</span>
                            <a href="{{ asset('storage/' . $karyailmiah->daftar_pustaka) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->file_jurnal)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>Jurnal</span>
                            <a href="{{ asset('storage/' . $karyailmiah->file_jurnal) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
                @if ($karyailmiah->sertifikat)
                    <div class="row py-3">
                        <div class="col-4">
                            <img src="/img/doc/doc.png" alt="Document">
                        </div>
                        <div class="col-8 row">
                            <span>Sertifikat</span>
                            <a href="{{ asset('storage/' . $karyailmiah->sertifikat) }}" target="_blank">Download</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
