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

    <!-- Ekstra -->
    <?php if ($jE > 0) : ?>
    <div class="container">
        <div class="text-center pt-4">
            <h1><strong>Ektrakurikuler</strong></h1>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 pt-3">
            @foreach ($Ekstra as $E)
            <div class="col-md-4 col-sm-6 col-xs-12" data-aos="fade-up" data-aos-duration="3000" data-aos-easing="ease">
                <div class="card shadow mb-4 text-center" style="border-color: #0bc15e; border-radius: 25px; border-width: 3px;">
                    <img src="{{  url('') }}/img/foto/ekstra/{{ $E->foto_ekstra }}" class="card-img-top" alt="..." style="border-radius: 25px; margin: 17px 17px 0px 17px; width: auto; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title" style="text-decoration-color: #0bc15e;">{{ $E->nama_ekstra }}</h5>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#{{ $E->id_detail }}">
                        Detail
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="{{ $E->id_detail }}" tabindex="-1" aria-labelledby="{{ $E->id_detail }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ $E->id_detail }}Label">Detail Ekstrakurikuler</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{ $E->detail_ekstra }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            </div>
                            </div>
                        </div>
                        </div>
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
