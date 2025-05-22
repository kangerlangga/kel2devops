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
    @foreach ($Sejarah as $S)
    <p class="font-italic text-danger mt-3">Terakhir Diperbarui : <b>{{ $S->update_tgl }} </b>
        @if (Auth::user()->level == 'Super Admin')
        <b>({{ $S->modified_by }})</b>
        @endif
    </p>
    @if ($S->visib_sejarah == 'Tampilkan')
        <p class="font-italic text-success"><i class="fas fa-fw fa-solid fa-eye"></i> Published</p>
    @elseif ($S->visib_sejarah == 'Sembunyikan')
        <p class="font-italic text-warning"><i class="fas fa-fw fa-solid fa-eye-slash"></i> Unpublished</p>
    @endif
    <div class="text-center pt-2">
        <img src="{{  url('') }}/img/foto/sejarah/{{ $S->foto_sejarah }}" class="img-thumbnail m-3" style="max-width: 50vw; border-radius: 25px;">
    </div>
    <div class="lead mt-2 mb-3" style="text-align: justify;">
        <?= $S['detail_sejarah']; ?>
    </div>
    <form action="{{ route('sejarah.edit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="{{ $S->id_sejarah }}">
        <button type="submit" class="btn btn-warning">Perbarui Sejarah</button>
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
