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
<form method="POST" action="{{ route('ekstra.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="Foto">Foto Ekstrakurikuler (PNG, JPG, JPEG) <b>Maksimal 3 MB</b> Ukuran Standar 1280px x 720px</label>
                <input class="form-control-file @error('Foto') is-invalid @enderror" name="Foto" id="Foto" type="file" accept=".png, .jpg, .jpeg" @error('Foto') aria-describedby="FotoFeedback" @enderror required>
                @error('Foto')
                <div id="FotoFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Nama">Nama Ekstrakurikuler</label>
                <input class="form-control @error('Nama') is-invalid @enderror" type="text" name="Nama" value="{{ old('Nama') }}" id="Nama" @error('Nama') aria-describedby="NamaFeedback" @enderror required>
                @error('Nama')
                <div id="NamaFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Detail">Detail Ekstrakurikuler</label>
                <input class="form-control @error('Detail') is-invalid @enderror" type="text" name="Detail" value="{{ old('Detail') }}" id="Detail"  @error('Detail') aria-describedby="DetailFeedback" @enderror required>
                @error('Detail')
                <div id="DetailFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Visibilitas">Visibilitas Ekstrakurikuler</label>
                <br>
                <select name='visibilitas' id='Visibilitas' class="form-control">
                    <option name='visibilitas' value='Tampilkan'>Tampilkan</option>
                    <option name='visibilitas' value='Sembunyikan'>Sembunyikan</option>
                </select>
            </div>
        </div>

    </div>
    <br>
    <button type="submit" class="btn btn-primary">TAMBAH</button>
    <button type="reset" class="btn btn-success">RESET</button>
</form>
<hr>

<script>
    //message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
@endsection
