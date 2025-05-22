<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.public.head')
</head>

@section('content')
<div id="preloader"></div>
<style>
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: #fff;
}
#preloader:before {
  content: "";
  position: fixed;
  top: calc(50% - 30px);
  left: calc(50% - 30px);
  border: 6px solid #05C05B;
  border-top-color: #e7e4fe;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: animate-preloader 1s linear infinite;
}
@keyframes animate-preloader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

<main>
    @include('layouts.public.styleA')
    @include('layouts.public.nav')
    <content>
        <?php if ($jB > 0) : ?>
        <!--Slide Image-->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <?php $no = 1; ?>
                    @foreach ($Beranda as $B)
                        <div class="carousel-item {{ $no == 1 ? 'active' : '' }}">
                            <img src="{{ url('') }}/img/foto/beranda/{{ $B->foto_beranda }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" style="background-color: #EDFFF8; opacity: 0.8; margin-bottom: 45vh; padding-left: 20px; padding-right: 20px; border-radius: 15px;">
                                <h5 style="color: #000" class="fw-bold">{{ $B->judul_beranda }}</h5>
                                <p style="color: #000">{{ $B->desk_beranda }}</p>
                                <a href="{{ $B->link_beranda }}" target="_blank" class="btn" style="color: #fff; background-color: #05C05B; opacity: 1;">Detail</a>
                            </div>
                        </div>
                        <?php $no++; ?>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelum</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Berikut</span>
                </button>
            </div>
        </div>
        <?php endif;?>

        <!-- Sejarah -->
        <?php if ($jS == 1) : ?>
        @foreach ($Sejarah as $S)
        <div class="container">
            <div class="text-center pt-4">
                <h1><strong>Sejarah</strong></h1>
                <img src="{{  url('') }}/img/foto/sejarah/{{ $S->foto_sejarah }}" class="img-thumbnail m-3" style="max-width: 70vw; border-radius: 25px;">
            </div>
            <div class="lead mt-2 mb-5" style="text-align: justify">
                <?= $S['detail_sejarah']; ?>
            </div>
        </div>
        @endforeach
        <?php endif;?>

        <!--Galery-->
        <?php if ($jG > 0) : ?>
        <section style="background-color: #05C05B;">
            <div class="container">
            <div class="text-center pt-4 text-white">
                    <h1><strong>Galeri</strong></h1>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 pt-3">
                    @foreach ($Galeri as $G)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card shadow mb-4 text-center" style="border-color: #0bc15e; border-radius: 25px; border-width: 3px;">
                            <img src="{{ url('') }}/img/foto/galeri/{{ $G->foto_galeri }}" class="card-img-top" alt="..." style="border-radius: 25px; margin: 17px 17px 0px 17px; width: auto; height: auto;">
                            <div class="card-body">
                                <h5 class="card-title" style="text-decoration-color: #0bc15e;">{{ $G->judul_galeri }}</h5>
                                <p class="card-text" style="text-align: justify;">{{ $G->desk_galeri }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <?php endif;?>

        <!-- Kontak -->
        <?php if ($jK > 0) : ?>
        @foreach ($Kontak as $K)
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 mt-3">
                <div class="col">
                    <div class="m-0 pb-5 pb-lg-0">
                        <div class="d-flex justify-content-start mb-1">
                            <div>
                                <h2 class="fw-bold mb-3">Kontak Kami</h2>
                                <div class="underbar ms-0"></div>
                            </div>
                        </div>
                        <p class="mb-2 fw-bold">Email :</p>
                        <p class="mb-3">{{ $K->email_kontak }}</p>
                        {{-- <p class="mb-2 fw-bold">Kontak :</p>
                        <p class="mb-1">Telepon : +62 {{ $K->telp_kontak }}
                            {{ $K->wa_kontak == 'Tersedia' ? '(Whatsapp)' : '' }}
                        </p>
                        <?php if ($K->wa_kontak == 'Tersedia') : ?>
                        <a href="https://api.whatsapp.com/send/?phone=62{{ $K->telp_kontak }}" target="_blank" class="btn btn-success">Chat Sekarang!</a>
                        <?php endif;?> --}}
                    </div>
                </div>
                <div class="col">
                    <div>
                        <div class="d-flex justify-content-start mb-1">
                            <div>
                                <h2 class="fw-bold mb-3">Alamat</h2>
                                <div class="underbar ms-0"></div>
                            </div>
                        </div>
                        <p class="mb-2">{{ $K->alamat_kontak }}</p>
                    </div>
                    <section class="rounded google-map overflow-hidden shadow-sm p-0" style="min-height: 350px; height: calc(100% - 372px);">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15824.42978994197!2d112.643887!3d-7.453364!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e137d8282191%3A0xc98f047271a99c09!2sSMP%20Negeri%202%20Tulangan!5e0!3m2!1sid!2sid!4v1705969822582!5m2!1sid!2sid" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </section>
                </div>
            </div>
        </div>
        @endforeach
        <?php endif;?>
    </content>
</main><!-- End #main -->
@include('layouts.public.footer')
@include('layouts.public.scriptB')
@endsection

<body>
    @yield('content')
</body>
</html>
