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
<form method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="Foto">Foto Pegawai (PNG, JPG, JPEG) <b>Maksimal 3 MB</b> Ukuran Standar 500px x 700px</label>
                <input class="form-control-file @error('Foto') is-invalid @enderror" name="Foto" id="Foto" type="file" accept=".png, .jpg, .jpeg" @error('Foto') aria-describedby="FotoFeedback" @enderror required>
                @error('Foto')
                <div id="FotoFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Nama">Nama Lengkap</label>
                <input class="form-control @error('Nama') is-invalid @enderror" type="text" name="Nama" value="{{ old('Nama') }}" id="Nama" @error('Nama') aria-describedby="NamaFeedback" @enderror required>
                @error('Nama')
                <div id="NamaFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Jabatan">Jabatan</label>
                <input class="form-control @error('Jabatan') is-invalid @enderror" type="text" name="Jabatan" value="{{ old('Jabatan') }}" id="Jabatan"  @error('Jabatan') aria-describedby="JabatanFeedback" @enderror required>
                @error('Jabatan')
                <div id="JabatanFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Visibilitas">Visibilitas Pegawai</label>
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
