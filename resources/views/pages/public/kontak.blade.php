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

</main><!-- End #main -->
@include('layouts.public.footer')
@include('layouts.public.scriptB')
@endsection

<body>
    @yield('content')
</body>
</html>
