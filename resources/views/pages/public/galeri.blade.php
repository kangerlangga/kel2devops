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

    <!-- Galeri -->
    <?php if ($jG > 0) : ?>
    <div class="container">
        <div class="text-center pt-4">
            <h1><strong>Galeri</strong></h1>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 pt-3 ">
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
    <?php endif;?>

</main><!-- End #main -->
@include('layouts.public.footer')
@include('layouts.public.scriptB')
@endsection

<body>
    @yield('content')
</body>
</html>
