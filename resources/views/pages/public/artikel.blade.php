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

.card-img-overlay {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.card:hover .card-img-overlay {
    opacity: 1;
}
.card-title, .card-text, .tbl {
    color: white;
    text-align: center;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.card:hover .card-title,
.card:hover .card-text,
.card:hover .tbl {
    opacity: 1;
    transform: translateY(0);
}
.card-img {
    transition: filter 0.3s ease;
}
.card:hover .card-img {
    filter: blur(1.5px);
}
</style>

<main>
    @include('layouts.public.styleA')
    @include('layouts.public.nav')

    <!-- Artikel -->
    <div class="container">
        <div class="text-center pt-4">
            <h1><strong>Artikel</strong></h1>
            <?php if ($jA == 0) : ?>
            <img src="{{  url('') }}/img/comingsoon.png" class="img-thumbnail" style="max-width: 70%; border-width: 0px">
            <?php endif;?>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 pt-3">
            <?php if ($jA > 0) : ?>
            @foreach ($Artikel as $A)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="card text-white shadow mb-4">
                    <img src="{{ url('') }}/img/foto/artikel/{{ $A->foto_artikel }}" class="card-img" alt="...">
                    <div class="card-img-overlay text-center">
                    <h5 class="card-title">{{ $A->judul_artikel }}</h5>
                    <p class="card-text"><small>Penulis : <b>{{ $A->penulis_artikel }}</b> <br> {{ $A->format_tgl }}</small></p>
                    <a href="{{ route('artikel.detail', $A->id_detail) }}" class="btn btn-outline-light tbl">Baca Artikel</a>
                    </div>
                </div>
            </div>
            @endforeach
            <?php endif;?>
        </div>
    </div>

</main><!-- End #main -->
@include('layouts.public.footer')
@include('layouts.public.scriptB')
@endsection

<body>
    @yield('content')
</body>
</html>
