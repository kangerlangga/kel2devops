@extends('layouts.admin.admin')

@section('title')
<title>{{ $judul }} | SMPN 2 Tulangan</title>
@endsection

@section('pageHeading')
<h1 class="h3 mb-2 text-gray-800"><b>{{ $judul }}</b></h1>
@endsection

@section('page')
<style>
    .form-group {
        margin-top: 17px;
    }
    .form-group input, select{
        margin-top: 3px;
    }
    .btn {
        width: 100px;
        margin-right: 5px;
    }
</style>
<form method="POST" action="{{ route('beranda.update', $EditBeranda->id_beranda) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="Foto">Foto Beranda (PNG, JPG, JPEG) <b>Maksimal 3 MB</b> Ukuran Standar 1500px x 800px</label>
                <input class="form-control-file @error('Foto') is-invalid @enderror" name="Foto" id="Foto" type="file" accept=".png, .jpg, .jpeg" @error('Foto') aria-describedby="FotoFeedback" @enderror>
                @error('Foto')
                <div id="FotoFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="Judul">Judul Informasi</label>
                <input class="form-control @error('Judul') is-invalid @enderror" name="Judul" value="{{ old('Judul', $EditBeranda->judul_beranda) }}" id="Judul" @error('Judul') aria-describedby="JudulFeedback" @enderror required>
                @error('Judul')
                <div id="JudulFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="Deskripsi">Deskripsi Informasi</label>
                <input class="form-control @error('Deskripsi') is-invalid @enderror" name="Deskripsi" value="{{ old('Deskripsi', $EditBeranda->desk_beranda) }}" id="Deskripsi" @error('Deskripsi') aria-describedby="DeskripsiFeedback" @enderror required>
                @error('Deskripsi')
                <div id="DeskripsiFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Detail">URL / Link Detail Informasi</label>
                <input class="form-control @error('Detail') is-invalid @enderror" name="Detail" value="{{ old('Detail', $EditBeranda->link_beranda) }}" id="Detail" @error('Detail') aria-describedby="DetailFeedback" @enderror type="url" required>
                @error('Detail')
                <div id="DetailFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Visibilitas">Visibilitas Beranda</label>
                <br>
                <select name='visibilitas' id='Visibilitas' class="form-control">
                    <option name='visibilitas' value='Tampilkan' {{ $EditBeranda->visib_beranda == 'Tampilkan' ? 'selected' : '' }}>Tampilkan</option>
                    <option name='visibilitas' value='Sembunyikan' {{ $EditBeranda->visib_beranda == 'Sembunyikan' ? 'selected' : '' }}>Sembunyikan</option>
                </select>
            </div>
        </div>

    </div>
    <br>
    <button type="submit" class="btn btn-primary">SIMPAN</button>
    <a href="{{ route('beranda.data') }}" class="btn btn-success tbl-kembali">KEMBALI</a>
</form>
<hr>

<script type="text/javascript">

    $(document).on('click','.tbl-kembali',function(e) {

    //Hentikan aksi default
    e.preventDefault();
    const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Perubahan Tidak Akan Disimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'KEMBALI',
            cancelButtonText: 'BATAL'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        })
    })
</script>
@endsection
