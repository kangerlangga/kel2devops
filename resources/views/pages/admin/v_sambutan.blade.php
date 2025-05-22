@extends('layouts.admin.admin')

@section('title')
<title>{{ $judul }} | SMPN 2 Tulangan</title>
@endsection

@section('pageHeading')
<h1 class="h3 mb-2 text-gray-800"><b>{{ $judul }}</b></h1>
@endsection

@section('page')
<div class="container">
    <?php if ($jS == 1) : ?>
    @foreach ($Sambutan as $S)
    <p class="font-italic text-danger mt-3">Terakhir Diperbarui : <b>{{ $S->update_tgl }} </b>
        @if (Auth::user()->level == 'Super Admin')
        <b>({{ $S->modified_by }})</b>
        @endif
    </p>
    @if ($S->visib_sambutan == 'Tampilkan')
        <p class="font-italic text-success"><i class="fas fa-fw fa-solid fa-eye"></i> Published</p>
    @elseif ($S->visib_sambutan == 'Sembunyikan')
        <p class="font-italic text-warning"><i class="fas fa-fw fa-solid fa-eye-slash"></i> Unpublished</p>
    @endif
    <div class="text-center pt-2">
        <img src="{{  url('') }}/img/foto/sambutan/{{ $S->foto_sambutan }}" class="img-thumbnail m-3" style="max-height: 45vh; border-radius: 25px;">
    </div>
    <div style="text-align: center;">
        <h3><b>{{ $S->nama_sambutan }}</b></h3>
        <p>{{ $S->jabatan_sambutan }}</p>
    </div>
    <div class="lead mt-2 mb-3" style="text-align: justify;">
        <?= $S['isi_sambutan']; ?>
    </div>
    <form action="{{ route('sambutan.edit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="{{ $S->id_sambutan }}">
        <button type="submit" class="btn btn-warning">Perbarui Sambutan</button>
    </form>
    @endforeach
    <?php endif;?>
</div>

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
