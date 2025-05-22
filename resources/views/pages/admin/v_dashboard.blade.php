@extends('layouts.admin.admin')

@section('title')
<title>{{ $judul }} | SMPN 2 Tulangan</title>
@endsection

@section('pageHeading')
<h1 class="h3 mb-2 text-gray-800"><b>{{ $judul }}</b></h1>
@endsection

@section('page')
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-uppercase mb-0 font-weight-bold text-gray-800">
                            <span class="text-success text-lg text-capitalize">Beranda</span>
                        </div>
                        <div class="text-lg font-weight-bold text-dark mb-1">
                            <i class="fas fa-fw fa-solid fa-eye"></i> {{ $jBs }} Item
                            <?php if ($jBh > 0) : ?>
                            | <i class="fas fa-fw fa-solid fa-eye-slash"></i> {{ $jBh }} Item
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-house fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-uppercase mb-0 font-weight-bold text-gray-800">
                        <span class="text-danger text-lg text-capitalize">Guru & Pegawai</span>
                        </div>
                        <div class="text-lg font-weight-bold text-dark mb-1">
                            <i class="fas fa-fw fa-solid fa-eye"></i> {{ $jPs }} Orang
                            <?php if ($jPh > 0) : ?>
                            | <i class="fas fa-fw fa-solid fa-eye-slash"></i> {{ $jPh }} Orang
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-uppercase mb-0 font-weight-bold text-gray-800">
                        <span class="text-info text-lg text-capitalize">Ekstrakurikuler</span>
                        </div>
                        <div class="text-lg font-weight-bold text-dark mb-1">
                            <i class="fas fa-fw fa-solid fa-eye"></i> {{ $jEs }} Ekstra
                            <?php if ($jEh > 0) : ?>
                            | <i class="fas fa-fw fa-solid fa-eye-slash"></i> {{ $jEh }} Ekstra
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-uppercase mb-0 font-weight-bold text-gray-800">
                        <span class="text-warning text-lg text-capitalize">Galeri</span>
                        </div>
                        <div class="text-lg font-weight-bold text-dark mb-1">
                            <i class="fas fa-fw fa-solid fa-eye"></i> {{ $jGs }} Item
                            <?php if ($jGh > 0) : ?>
                            | <i class="fas fa-fw fa-solid fa-eye-slash"></i> {{ $jGh }} Item
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-images fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-uppercase mb-0 font-weight-bold text-gray-800">
                        <span class="text-primary text-lg text-capitalize">Artikel</span>
                        </div>
                        <div class="text-lg font-weight-bold text-dark mb-1">
                            <i class="fas fa-fw fa-solid fa-eye"></i> {{ $jAs }} Artikel
                            <?php if ($jAh > 0) : ?>
                            | <i class="fas fa-fw fa-solid fa-eye-slash"></i> {{ $jAh }} Artikel
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs text-uppercase mb-0 font-weight-bold text-gray-800">
                        <span class="text-dark text-lg text-capitalize">Berita</span>
                        </div>
                        <div class="text-lg font-weight-bold text-dark mb-1">
                            <i class="fas fa-fw fa-solid fa-eye"></i> {{ $jBTs }} Berita
                            <?php if ($jBTh > 0) : ?>
                            | <i class="fas fa-fw fa-solid fa-eye-slash"></i> {{ $jBTh }} Berita
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //message with sweetalert
    @if(session('successprof'))
        Swal.fire({
            icon: "success",
            title: "{{ session('successprof') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @elseif(session('successlog'))
        Swal.fire({
            icon: "success",
            title: "{{ session('successlog') }}",
            text: 'Disarankan Membuka Halaman Administrasi Dengan Komputer atau Laptop!',
        });
    @endif
</script>
@endsection
