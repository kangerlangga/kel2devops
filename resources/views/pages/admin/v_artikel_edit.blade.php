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
<form method="POST" action="{{ route('artikel.update', $EditArtikel->id_artikel) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="Foto">Gambar Pendukung (PNG, JPG, JPEG) <b>Maksimal 3 MB</b> Ukuran Standar 750px x 500px</label>
                <input class="form-control-file @error('Foto') is-invalid @enderror" name="Foto" id="Foto" type="file" accept=".png, .jpg, .jpeg" @error('Foto') aria-describedby="FotoFeedback" @enderror>
                @error('Foto')
                <div id="FotoFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="Judul">Judul Artikel</label>
                <input class="form-control @error('Judul') is-invalid @enderror" type="text" name="Judul" value="{{ old('Judul', $EditArtikel->judul_artikel) }}" id="Judul" @error('Judul') aria-describedby="JudulFeedback" @enderror required>
                @error('Judul')
                <div id="JudulFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="Isi">Isi Artikel</label>
                <textarea class="form-control @error('Isi') is-invalid @enderror" id="Isi" name="Isi" @error('Isi') aria-describedby="IsiFeedback" @enderror>{{ old('Isi', $EditArtikel->isi_artikel) }}</textarea>
                @error('Isi')
                <div id="IsiFeedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Visibilitas">Visibilitas Artikel</label>
                <br>
                <select name='visibilitas' id='Visibilitas' class="form-control">
                    <option name='visibilitas' value='Tampilkan' {{ $EditArtikel->visib_artikel == 'Tampilkan' ? 'selected' : '' }}>Tampilkan</option>
                    <option name='visibilitas' value='Sembunyikan' {{ $EditArtikel->visib_artikel == 'Sembunyikan' ? 'selected' : '' }}>Sembunyikan</option>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="Nama-Pengguna">Penulis</label>
                <input class="form-control" name="penulis" value="{{ $EditArtikel->penulis_artikel }}" id="Nama-Pengguna" readonly style="cursor: not-allowed">
            </div>
        </div>

    </div>
    <br>
    <button type="submit" class="btn btn-primary">SIMPAN</button>
    <a href="{{ route('artikel.data') }}" class="btn btn-success tbl-kembali">KEMBALI</a>
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
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font,
        Image,
        ImageToolbar,
        ImageCaption,
        ImageStyle,
        ImageUpload,
        ImageResize
    } from 'ckeditor5';
    ClassicEditor
        .create( document.querySelector( '#Isi' ), {
            plugins: [
                Essentials, Paragraph, Bold, Italic, Font,
                Image, ImageToolbar, ImageCaption, ImageStyle, ImageUpload, ImageResize
            ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'imageUpload', 'imageStyle:full', 'imageStyle:side', 'imageTextAlternative'
            ],
            image: {
                toolbar: [
                    'imageStyle:full', 'imageStyle:side', '|',
                    'imageTextAlternative', 'imageResize'
                ]
            }
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    window.onload = function() {
        if ( window.location.protocol === 'file:' ) {
            alert( 'This sample requires an HTTP server. Please serve this file with a web server.' );
        }
    };
</script>
@endsection
