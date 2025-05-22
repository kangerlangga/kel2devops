<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PRECONNECT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://www.w3.org">
    <link rel="preconnect" href="https://www.w3.org">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- SIMPLE META -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name="google" content="notranslate">
    <meta name="googlebot" content="index,follow">
    <meta name="author" content="SMPN 2 Tulangan">
    <meta name="language" content="id">
    <meta name="geo.country" content="id">
    <meta name="geo.placename" content="Indonesia">
    <meta name="robots" content="all,index,follow">
	<meta NAME="Distribution" CONTENT="Global">
	<meta NAME="Rating" CONTENT="General">
	<meta name="google-site-verification" content="PQ4dLR4Hgn4FSuZ7UKdgkIz-9MJ5kBoTT3RqLmuZ6l8" />

    <!-- WEBSITE META -->
    <title>Page Not Found | SMPN 2 Tulangan</title>
    <meta name="keywords" content="SMPN 2 TULANGAN, Spendatu">
    <meta name="description" content="SMP Negeri 2 Tulangan Sidoarjo adalah sebuah sekolah menengah pertama negeri yang terletak di Kecamatan Tulangan, Kabupaten Sidoarjo, Jawa Timur, Indonesia.">
    <link rel="icon" type="image/png" href="https://smpn2tulangan.sch.id/img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,900" rel="stylesheet">
</head>
<body>
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

    * {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    }

    body {
    padding: 0;
    margin: 0;
    }

    #notfound {
    position: relative;
    height: 100vh;
    }

    #notfound .notfound {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
    }

    .notfound {
    max-width: 920px;
    width: 100%;
    line-height: 1.4;
    text-align: center;
    padding-left: 15px;
    padding-right: 15px;
    }

    .notfound .notfound-404 {
    position: absolute;
    height: 100px;
    top: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
            transform: translateX(-50%);
    z-index: -1;
    }

    .notfound .notfound-404 h1 {
    font-family: 'Maven Pro', sans-serif;
    color: #ececec;
    font-weight: 900;
    font-size: 276px;
    margin: 0px;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
    }

    .notfound h2 {
    font-family: 'Maven Pro', sans-serif;
    font-size: 46px;
    color: #000;
    font-weight: 900;
    text-transform: uppercase;
    margin: 0px;
    }

    .notfound p {
    font-family: 'Maven Pro', sans-serif;
    font-size: 16px;
    color: #000;
    font-weight: 400;
    text-transform: uppercase;
    margin-top: 15px;
    }

    .notfound a {
    font-family: 'Maven Pro', sans-serif;
    font-size: 14px;
    text-decoration: none;
    text-transform: uppercase;
    background: #05C05B;
    display: inline-block;
    padding: 16px 38px;
    border: 2px solid transparent;
    border-radius: 40px;
    color: #fff;
    font-weight: 400;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
    }

    .notfound a:hover {
    background-color: #fff;
    border-color: #05C05B;
    color: #05C05B;
    }

    @media only screen and (max-width: 480px) {
    .notfound .notfound-404 h1 {
        font-size: 162px;
    }
    .notfound h2 {
        font-size: 26px;
    }
    }
    </style>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>We are sorry, Page not found!</h2>
			<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
			<a href="{{ route('beranda.publik') }}">Back To Homepage</a>
		</div>
	</div>
    <script>
        (function() {
            "use strict";
            const select = (el, all = false) => {
            el = el.trim();
            if (all) {
                return [...document.querySelectorAll(el)];
            } else {
                return document.querySelector(el);
            }
            };
            let preloader = select('#preloader');
            if (preloader) {
            window.addEventListener('load', () => {
                preloader.remove();
            });
            }
        })();
    </script>
</body>
</html>