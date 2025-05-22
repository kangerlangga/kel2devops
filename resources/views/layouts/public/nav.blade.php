<nav class="nav" style="background-color: #05C05B;">
    <div class="container">
    <ul class="nav">
        <?php if ($jK > 0) : ?>
        @foreach ($Kontak as $K)
        {{-- <li class="nav-item" style="margin: 0px">
            <a class="nav-link" target="_blank" href="#"><i class="fa-brands fa-fw fa-whatsapp"></i> 0{{ $K->telp_kontak }}</a>
        </li> --}}
        <li class="nav-item" style="margin: 0px">
            <a class="nav-link" target="_blank" href="mailto:{{ $K->email_kontak }}"><i class="fa-solid fa-fw fa-envelope"></i> {{ $K->email_kontak }}</a>
        </li>
        @endforeach
        <?php endif;?>
        <li class="nav-item" style="margin: 0px">
            <a class="nav-link" target="_blank" href="https://smp-spmbsidoarjo.id"><i class="fa-solid fa-fw fa-book"></i> SPMB</a>
        </li>
    </ul>
    </div>
</nav>
<!-- Batas Navigasi Tengah -->
<nav class="nav pt-3 pb-3" style="background-color: #fff;">
    <div class="container">
        <ul class="nav" style="align-items: center;">
            <li class="nav-item">
                <a class="nav-link mt-0 mb-0" href="#">
                    <img src="{{  url('') }}/img/logo.png" alt=""  height="130">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <h3 style="color: #000;">SMP NEGERI 2 TULANGAN</h3>
                    <h5 style="color: #000;">Membangun Karakter Peserta Didik Cerdas Spiritual, Akademis, Emosional</h5>
                </a>
            </li>
        </ul>
    </div>
    </div>
</nav>
<!-- Navigasi Bawah -->
<nav class="navbar navbar-expand-lg navbar-dark nav" style="background-color: #05C05B;">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link menu {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('beranda.publik') }}" style="{{ request()->is('/') ? 'background-color: #FFB320;' : '' }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link menu dropdown-toggle {{ request()->is('sejarah*', 'sambutan*', 'pegawai*', 'ekstra*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="{{ request()->is('sejarah*', 'sambutan*', 'pegawai*', 'ekstra*') ? 'background-color: #FFB320;' : '' }}">
                        Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" style="background-color: #05C05B;">
                        <li>
                            <a class="dropdown-item fw-bold text-white {{ request()->is('sejarah*') ? 'active' : '' }}" href="{{ route('sejarah.publik') }}" style="{{ request()->is('sejarah*') ? 'background-color: #FFB320;' : '' }}">Sejarah</a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-bold text-white {{ request()->is('sambutan*') ? 'active' : '' }}" href="{{ route('sambutan.publik') }}" style="{{ request()->is('sambutan*') ? 'background-color: #FFB320;' : '' }}">Sambutan Kepala Sekolah</a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-bold text-white {{ request()->is('pegawai*') ? 'active' : '' }}" href="{{ route('pegawai.publik') }}" style="{{ request()->is('pegawai*') ? 'background-color: #FFB320;' : '' }}">Guru & Pegawai</a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-bold text-white {{ request()->is('ekstra*') ? 'active' : '' }}" href="{{ route('ekstra.publik') }}" style="{{ request()->is('ekstra*') ? 'background-color: #FFB320;' : '' }}">Ekstrakurikuler</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ route('galeri.publik') }}" style="{{ request()->is('galeri*') ? 'background-color: #FFB320;' : '' }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu {{ request()->is('artikel*') ? 'active' : '' }}" href="{{ route('artikel.publik') }}" style="{{ request()->is('artikel*') ? 'background-color: #FFB320;' : '' }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu {{ request()->is('berita*') ? 'active' : '' }}" href="{{ route('berita.publik') }}" style="{{ request()->is('berita*') ? 'background-color: #FFB320;' : '' }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu {{ request()->is('kontak*') ? 'active' : '' }}" href="{{ route('kontak.publik') }}" style="{{ request()->is('kontak*') ? 'background-color: #FFB320;' : '' }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@if(app()->environment('local') || config('app.debug'))
    <div class="bg-danger text-white pt-1">
        <marquee behavior="scroll" direction="left" class="fw-bolder">Saat ini Situs sedang dalam proses peningkatan sistem untuk memberikan layanan yang lebih baik kepada Anda. Kami mohon maaf atas ketidaknyamanan yang ditimbulkan selama proses ini berlangsung. Terima kasih atas pengertian Anda.</marquee>
    </div>
@endif
