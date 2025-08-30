<h4>Telusuri berdasarkan</h4>
<form class="row g-3 py-4" action="/karyailmiah">
    <div class="col-md-2">
        <select class="form-select shadow-sm border-0 fst-italic" name="tahun">
            <option selected disabled value="">Tahun</option>
            @foreach ($tahuns as $tahun)
                @if (request('tahun') == $tahun->tahun)
                    <option value="{{ $tahun->tahun }}" selected>{{ $tahun->tahun }}</option>
                @else
                    <option value="{{ $tahun->tahun }}">{{ $tahun->tahun }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select class="form-select shadow-sm border-0 fst-italic" name="rumpun">
            <option selected disabled value="">Rumpun</option>
            @foreach ($rumpuns as $rumpun)
                @if (request('rumpun') == $rumpun->nama)
                    <option value="{{ $rumpun->nama }}" selected>{{ $rumpun->nama }}</option>
                @else
                    <option value="{{ $rumpun->nama }}">{{ $rumpun->nama }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control shadow-sm border-0 fst-italic"
            value="@if (request('subjek')) {{ request('subjek') }} @endif" placeholder="Subjek"
            name="subjek">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control shadow-sm border-0 fst-italic"
            value="@if (request('penulis')) {{ request('penulis') }} @endif" placeholder="Penulis" name="penulis">
    </div>
    <div class="col-md-2 d-grid">
        <button class="btn shadow-sm" type="submit" style="background-color: #E9DFEA">Telusuri</button>
    </div>
</form>
