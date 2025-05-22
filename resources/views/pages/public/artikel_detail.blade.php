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

.publication-info {
    background-color: #DCDCDC;
    opacity: 0.7;
    border: 1px solid #ccc;
    font-weight: 600;
    margin-left: 1px;
    margin-right: 1px;
    padding: 10px;
    margin-bottom: 20px;
}

.publication-info p {
    margin: 0;
    padding: 5px 0;
}

.publication-info b {
    color: #333;
}

.highlight {
    color: #197a35;
}

@media screen and (max-width: 768px) {
    .isi img {
        display: none;
    }
}
</style>

<main>
    @include('layouts.public.styleA')
    @include('layouts.public.nav')

    <!-- Artikel -->
    <div class="container">
        <div class="pt-4">
            <h1><strong>{{ $DetailArtikel->judul_artikel }}</strong></h1>
            <div class="publication-info">
                <p><b>Dipublikasikan pada : <span class="highlight">{{ $DetailArtikel->format_tgl }},</span>
                 Oleh : <span class="highlight">{{ $DetailArtikel->penulis_artikel }}</span></b></p>
            </div>
        </div>
        <div class="isi pb-3">
            <?= $DetailArtikel['isi_artikel']; ?>
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
