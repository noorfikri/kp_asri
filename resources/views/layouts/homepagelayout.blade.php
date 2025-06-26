<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - {{$storeInfo->name}}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ $storeInfo && $storeInfo->store_logo ? asset($storeInfo->store_logo) : asset('assets/img/favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@yield('javascript')

</head>
<body>
    <header class = "navbar_container">
        <div class = "logo">
            <img src="{{asset($storeInfo->banner)}}" alt="Logo">
        </div>
        <nav class = "navlist">
            <ul>
                <li>
                    <a href="{{url('/')}}">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}">Galeri</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Hubungi Kami</a>
                </li>
                <li>
                    <a href="{{url('/admin')}}">Masuk Karyawan</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div id = "footer_logo">
            <img src="{{asset($storeInfo->banner)}}" alt="Logo">
        </div>
        <div id = "footer_info">
            <h1>{{$storeInfo->name}}</h1>
            <p>{{$storeInfo->address}}</p>
        </div>
        <div id = "footer_kontak">
            <h1>Kontak</h1>
            <i class = "fas fa-phone">
                <p> {{$storeInfo->phone}} </p>
            </i>
            <i class = "fab fa-whatsapp">
                <p> {{$storeInfo->whatsapp}} </p>
            </i>
        </div>
        <div id = "footer_menu">
                <a href="{{url('/')}}">Beranda</a>
                <a href="{{ route('gallery') }}">Galeri</a>
                <a href="{{ route('contact') }}">Hubungi Kami</a>
                <p></p>
                <a href="{{url('/admin')}}">Masuk Karyawan</a>
        </div>
        <div id = "footer_credits">
            <p><b>Website {{$storeInfo->name}} &#169; 2024,</b> Wildan Achmad Noorfikri</p>
        </div>
    </footer>
</body>
</html>
