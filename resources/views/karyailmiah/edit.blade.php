@extends('layouts.main')

@section('container')
    <form class="row justify-content-evenly" method="POST" action="/karyailmiah/{{ $karyailmiah->slug }}" enctype="multipart/form-data"
        onload="tampilFile()">
        @csrf
        @method('PUT')
        <input class="d-none" type="text" name="slug" id="slug"
            value="{{ old('slug', $karyailmiah->slug) }}{{ mt_rand(0, 9) }}">
        @error('slug')
            <div class="invalid-feedback d-block text-center pb-5">
                Terdapat judul yang sama pada database. Silahkan isi kembali file dan kirim ulang!!
            </div>
        @enderror
        <div class="col-lg-7">
            <div class="mb-3 row">
                <label for="tipe" class="col-sm-3 col-form-label">Tipe Karya Ilmiah</label>
                <div class="col-sm-9">
                    <select class="form-select shadow-sm border-0 @error('tipe') is-invalid @enderror" name="tipe"
                        id="tipe" onchange="tampilFile()" disabled>
                        @foreach ($tipes as $tipe)
                            @if (old('tipe', $karyailmiah->tipe) == $tipe)
                                <option value="{{ $tipe }}" selected>{{ $tipe }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('tipe')
                        <div class="invalid-feedback d-block text-end">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row haki hide" style="display: none!important;">
                <label for="no_hki" class="col-sm-3 col-form-label">No HKI</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('no_hki') is-invalid @enderror" name="no_hki"
                        id="no_hki" value="{{ old('no_hki', $karyailmiah->no_hki) }}" onkeyup="createTextSlugFromHKI()">
                </div>
                @error('no_hki')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row haki hide" style="display: none!important;">
                <label for="tanggal_permohonan" class="col-sm-3 col-form-label">Tanggal Permohonan</label>
                <div class="col-sm-9">
                    <input type="date"
                        class="form-control shadow-sm border-0 mb-3 @error('tanggal_permohonan') is-invalid @enderror"
                        name="tanggal_permohonan" id="tanggal_permohonan" value="{{ old('tanggal_permohonan', $karyailmiah->tanggal_permohonan) }}">
                </div>
                @error('tanggal_permohonan')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row haki hide" style="display: none!important;">
                <label for="nama_pemegang" class="col-sm-3 col-form-label">Nama Pemegang</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('nama_pemegang') is-invalid @enderror" name="nama_pemegang"
                        id="nama_pemegang" value="{{ old('nama_pemegang', $karyailmiah->nama_pemegang) }}">
                </div>
                @error('nama_pemegang')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row haki hide" style="display: none!important;">
                <label for="jenis_ciptaan" class="col-sm-3 col-form-label">Jenis Ciptaan</label>
                <div class="col-sm-9">
                    <select class="form-select shadow-sm border-0 @error('jenis_ciptaan') is-invalid @enderror" name="jenis_ciptaan">
                        <option disabled selected>Pilih Jenis Ciptaan</option>
                        @foreach ($jenis_ciptaans as $jenis_ciptaan)
                            @if (old('jenis_ciptaan', $karyailmiah->jenis_ciptaan) == $jenis_ciptaan)
                                <option value="{{ $jenis_ciptaan }}" selected>{{ $jenis_ciptaan }}</option>
                            @else
                                <option value="{{ $jenis_ciptaan }}">{{ $jenis_ciptaan }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error('jenis_ciptaan')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row skripsi jurnal haki hide" style="display: none!important;">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-9">
                    <input class="form-control shadow-sm border-0 @error('judul') is-invalid @enderror" rows="2"
                        name="judul" id="judul" onkeyup="createTextSlugFromJudul()" value="{{ old('judul', $karyailmiah->judul) }}">
                </div>
                @error('judul')
                    <div class="invalid-feedback d-block text-end d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal skripsi hide" style="display: none!important;">
                <label for="rumpun" class="col-sm-3 col-form-label">Rumpun</label>
                <div class="col-sm-9">
                    <select class="form-select shadow-sm border-0 @error('rumpun') is-invalid @enderror" name="rumpun_id"
                        onchange="disableProdi()" id="rumpun">
                        <option disabled selected>Pilih Rumpun</option>
                        @foreach ($rumpuns as $rumpun)
                            @if (old('rumpun_id', $karyailmiah->rumpun_id) == $rumpun->id)
                                <option value="{{ $rumpun->id }}" selected>{{ $rumpun->nama }}</option>
                            @else
                                <option value="{{ $rumpun->id }}">{{ $rumpun->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error('rumpun')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 row jurnal skripsi hide" style="display: none!important;">
                <label for="prodi" class="col-sm-3 col-form-label">Prodi</label>
                <div class="col-sm-9">
                    <select class="form-select shadow-sm border-0 @error('prodi') is-invalid @enderror" name="prodi_id"
                        disabled id="prodi">
                        <option disabled selected>Pilih Prodi</option>
                        @foreach ($prodis as $prodi)
                            @if (old('prodi_id', $karyailmiah->prodi_id) == $prodi->id)
                                <option value="{{ $prodi->id }}" selected
                                    class="disable rumpun{{ $prodi->rumpun_id }}">
                                    {{ $prodi->nama }}</option>
                            @else
                                <option value="{{ $prodi->id }}" class="disable rumpun{{ $prodi->rumpun_id }}">
                                    {{ $prodi->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @error('prodi')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3 row jurnal skripsi hide" style="display: none!important;">
                <label for="kata_kunci" class="col-sm-3 col-form-label">Kata Kunci</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control shadow-sm border-0 @error('kata_kunci') is-invalid @enderror"
                        name="kata_kunci" value="{{ old('kata_kunci', $karyailmiah->kata_kunci) }}">
                </div>
                @error('kata_kunci')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal skripsi hide" style="display: none!important;">
                <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('penulis') is-invalid @enderror" name="penulis"
                        id="penulis" value="{{ old('penulis', $karyailmiah->penulis) }}">
                        <div id="penulisHelp" class="form-text">Contoh: Penulis Satu, Penulis Dua</div>
                </div>
                @error('penulis')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="nama_jurnal" class="col-sm-3 col-form-label">Nama Jurnal</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('nama_jurnal') is-invalid @enderror"
                        name="nama_jurnal" id="nama_jurnal" value="{{ old('nama_jurnal', $karyailmiah->nama_jurnal) }}">
                </div>
                @error('nama_jurnal')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="tautan_laman" class="col-sm-3 col-form-label">Tautan Laman</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('tautan_laman') is-invalid @enderror"
                        name="tautan_laman" id="tautan_laman" value="{{ old('tautan_laman', $karyailmiah->tautan_laman) }}">
                </div>
                @error('tautan_laman')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="tanggal_terbit" class="col-sm-3 col-form-label">Tanggal Terbit</label>
                <div class="col-sm-9">
                    <input type="date"
                        class="form-control shadow-sm border-0 mb-3 @error('tanggal_terbit') is-invalid @enderror"
                        name="tanggal_terbit" id="tanggal_terbit" value="{{ old('tanggal_terbit', $karyailmiah->tanggal_terbit) }}">
                </div>
                @error('tanggal_terbit')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="volume" class="col-sm-3 col-form-label">Volume</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control shadow-sm border-0 mb-3 @error('volume') is-invalid @enderror"
                        name="volume" id="volume" value="{{ old('volume', $karyailmiah->volume) }}">
                </div>
                @error('volume')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="nomor" class="col-sm-3 col-form-label">Nomor</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('nomor') is-invalid @enderror" name="nomor"
                        id="nomor" value="{{ old('nomor', $karyailmiah->nomor) }}">
                </div>
                @error('nomor')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="halaman" class="col-sm-3 col-form-label">Halaman</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('halaman') is-invalid @enderror"
                        name="halaman" id="halaman" value="{{ old('halaman', $karyailmiah->halaman) }}">
                </div>
                @error('halaman')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('penerbit') is-invalid @enderror"
                        name="penerbit" id="penerbit" value="{{ old('penerbit', $karyailmiah->penerbit) }}">
                </div>
                @error('penerbit')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="doi" class="col-sm-3 col-form-label">DOI</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control shadow-sm border-0 mb-3 @error('doi') is-invalid @enderror"
                        name="doi" id="doi" value="{{ old('doi', $karyailmiah->doi) }}">
                </div>
                @error('doi')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal hide" style="display: none!important;">
                <label for="issn" class="col-sm-3 col-form-label">ISSN</label>
                <div class="col-sm-9">
                    <input type="text"
                        class="form-control shadow-sm border-0 mb-3 @error('issn') is-invalid @enderror" name="issn"
                        id="issn" value="{{ old('issn', $karyailmiah->issn) }}">
                </div>
                @error('issn')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal skripsi hide" style="display: none!important;">
                <label for="referensi" class="col-sm-3 col-form-label">Referensi</label>
                <div class="col-sm-9">
                    <textarea class="form-control shadow-sm border-0 @error('referensi') is-invalid @enderror" rows="2"
                        name="referensi">{{ old('referensi', $karyailmiah->referensi) }}</textarea>
                </div>
                @error('referensi')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 row jurnal skripsi hide" style="display: none!important;">
                <label for="abstrak" class="col-sm-3 col-form-label">Abstrak</label>
                <div class="col-sm-9"></div>
            </div>
            <div class="mb-3 row jurnal skripsi hide px-2" style="display: none!important;">
                <input id="abstrak" name="abstrak" type="hidden" name="content" style="text-align: justify" value="{{ old('abstrak', $karyailmiah->abstrak) }}">
                <trix-editor input="abstrak" class="shadow-sm border-0"></trix-editor>
                @error('abstrak')
                    <div class="invalid-feedback d-block text-end">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="row mt-5">
                <label for="referensi" class="col-sm-3 col-form-label">Catatan Admin</label>
                <p class="form-control" placeholder="Leave a comment here" id="floatingTextarea2Disabled"
                    style="height: 100px; border: 2px solid red">
                    {{ $karyailmiah->catatan }}
                </p>
            </div>
        </div>

        <div class="col-lg-4" id="tempatfile" style="display: none!important;">
            <div class="position-sticky" style="top: 2rem;">
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->cover) }}" target="_blank">
                            <label for="cover" class="form-label">Cover <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <label class="text-secondary mb-3" style="font-size: 10px; text-align: justify;">File terlampir berupa cover, lembar pengesahan, pernyataan penulis, kata pengantar</label>
                        <input class="form-control form-control-sm @error('cover') is-invalid @enderror" type="file"
                            name="cover">
                        @error('cover')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->file_abstrak) }}" target="_blank">
                            <label for="file_abstrak" class="form-label">Abstrak <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('file_abstrak') is-invalid @enderror"
                            type="file" name="file_abstrak">
                        @error('file_abstrak')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->daftar_isi) }}" target="_blank">
                            <label for="daftar_isi" class="form-label">Daftar Isi <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('daftar_isi') is-invalid @enderror"
                            type="file" name="daftar_isi">
                        @error('daftar_isi')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->bab_i) }}" target="_blank">
                            <label for="bab_i" class="form-label">BAB I <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('bab_i') is-invalid @enderror" type="file"
                            name="bab_i">
                        @error('bab_i')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->bab_ii) }}" target="_blank">
                            <label for="bab_ii" class="form-label">BAB II <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('bab_ii') is-invalid @enderror" type="file"
                            name="bab_ii">
                        @error('bab_ii')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->bab_iii) }}" target="_blank">
                            <label for="bab_iii" class="form-label">BAB III <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('bab_iii') is-invalid @enderror" type="file"
                            name="bab_iii">
                        @error('bab_iii')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->bab_iv) }}" target="_blank">
                            <label for="bab_iv" class="form-label">BAB IV <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('bab_iv') is-invalid @enderror" type="file"
                            name="bab_iv">
                        @error('bab_iv')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->bab_v) }}" target="_blank">
                            <label for="bab_v" class="form-label">BAB V <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('bab_v') is-invalid @enderror" type="file"
                            name="bab_v">
                        @error('bab_v')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 skripsi hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->daftar_pustaka) }}" target="_blank">
                            <label for="daftar_pustaka" class="form-label">Daftar Pustaka <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('daftar_pustaka') is-invalid @enderror"
                            type="file" name="daftar_pustaka">
                        @error('daftar_pustaka')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 haki hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->sertifikat) }}" target="_blank">
                            <label for="sertifikat" class="form-label">Sertifikat <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('sertifikat') is-invalid @enderror"
                            type="file" name="sertifikat">
                        @error('sertifikat')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 py-2 jurnal hide">
                    <div class="col-3">
                        <img src="/img/doc/doc.png" alt="Document">
                    </div>
                    <div class="col-9 mb-3">
                        <a href="{{ asset('storage/' . $karyailmiah->file_jurnal) }}" target="_blank">
                            <label for="file_jurnal" class="form-label">Upload File <span class="text-secondary"
                                    style="font-size: 10px;">max. 500kb *pdf</span></label>
                        </a>
                        <input class="form-control form-control-sm @error('file_jurnal') is-invalid @enderror"
                            type="file" name="file_jurnal">
                        @error('file_jurnal')
                            <div class="invalid-feedback d-block text-end">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-piksi" type="submit">Kirim File</button>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        const tempatFile = document.querySelector("#tempatfile");

        function tampilFile() {
            const tipe = document.getElementById("tipe");

            const skripsi = document.querySelectorAll(".skripsi");
            const jurnal = document.querySelectorAll(".jurnal");
            const haki = document.querySelectorAll(".haki");
            const hide = document.querySelectorAll(".hide");

            if (tipe.value === 'Skripsi / Tugas Akhir') {
                for (let i = 0; i < hide.length; i++) {
                    hide[i].style.display = "none";
                }
                for (let i = 0; i < skripsi.length; i++) {
                    skripsi[i].style.display = "";
                }
                tempatFile.style.display = "";
            }

            if (tipe.value === 'Jurnal') {
                for (let i = 0; i < hide.length; i++) {
                    hide[i].style.display = "none";
                }
                for (let i = 0; i < jurnal.length; i++) {
                    jurnal[i].style.display = "";
                }
                tempatFile.style.display = "";
            }

            if (tipe.value === 'HKI') {
                for (let i = 0; i < hide.length; i++) {
                    hide[i].style.display = "none";
                }
                for (let i = 0; i < haki.length; i++) {
                    haki[i].style.display = "";
                }
                tempatFile.style.display = "";
            }
        }

        function disableProdi() {
            const prodi = document.querySelector("#prodi");
            const rumpun = document.getElementById("rumpun");
            @foreach ($prodi_id as $p)
                const prodi{{ $p->rumpun_id }} = document.querySelectorAll(".rumpun{{ $p->rumpun_id }}");
            @endforeach
            const disable = document.querySelectorAll(".disable");

            @foreach ($prodi_id as $p)
                if (rumpun.value == {{ $p->rumpun_id }}) {
                    for (let i = 0; i < disable.length; i++) {
                        disable[i].disabled = true;
                    }
                    for (let i = 0; i < prodi{{ $p->rumpun_id }}.length; i++) {
                        prodi{{ $p->rumpun_id }}[i].disabled = false;
                    }
                    prodi.disabled = false;
                }
            @endforeach
        }

        function createTextSlugFromJudul() {
            var judul = document.getElementById("judul").value;
            document.getElementById("slug").value = generateSlug(judul);
        }

        function createTextSlugFromHKI() {
            var judul = document.getElementById("no_hki").value;
            document.getElementById("slug").value = generateSlug(judul);
        }

        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/^-+/, '')
                .replace(/-+$/, '')
                .replace(/\s+/g, '-')
                .replace(/\-\-+/g, '-')
                .replace(/[^\w\-]+/g, '');
        }

        window.onload = (event) => {
            tampilFile();
            disableProdi();
        };
    </script>
@endsection
