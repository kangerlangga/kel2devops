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

</main><!-- End #main -->
@include('layouts.public.footer')
@include('layouts.public.scriptB')
@endsection

<body>
    @yield('content')
</body>
</html>
