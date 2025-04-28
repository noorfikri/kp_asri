<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Toko Asri Busana Muslim</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Javascript Methods-->
    <script>
        function toggleAside() {
            var iconOpen = document.getElementById("btn_open")
            var iconClose = document.getElementById("btn_close")
            var asideContent = document.getElementById("aside_content")

            if (iconOpen.style.visibility == "visible"){
                iconOpen.style.visibility = "hidden"
                iconOpen.style.display = "none"

                iconClose.style.visibility = "visible"
                iconClose.style.display = "flex"

                asideContent.style.visibility = "visible"
                asideContent.style.display = "flex"
                asideContent.style.flexFlow = "column nowrap"
            } else {
                iconClose.style.visibility = "hidden"
                iconClose.style.display = "none"

                iconOpen.style.visibility = "visible"
                iconOpen.style.display = "flex"

                asideContent.style.visibility = "hidden"
                asideContent.style.display = "none"
            }
        }
    </script>

@yield('javascript')

</head>
<body>
    <header class = "navbar_container">
        <div class = "logo">
            <img src="{{asset('assets/img/Banner ASRI.png')}}" alt="Logo Toko Asri Kediri">
        </div>
        <nav class = "navlist">
            <ul>
                <li>
                    <a href="#home">Beranda</a>
                </li>
                <li>
                    <a href="#gallery">Galeri</a>
                </li>
                <li>
                    <a href="#contact">Kontak</a>
                </li>
                <li>
                    <a href="{{url('/dashboard')}}">Masuk</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div id = "footer_logo">
            <img src="{{asset('assets/img/Banner ASRI.png')}}" alt="Logo Toko Asri Kediri">
        </div>
        <div id = "footer_info">
            <h1>Toko Asri Busana Muslim</h1>
            <p>Jalan Raden Patah No.4, Kelurahan Kemasan, Kecamatan Kota, Kota Kediri, Jawa Timur</p>
        </div>
        <div id = "footer_kontak">
            <h1>Kontak</h1>
            <i class = "fas fa-phone">
                <p> (0354) 689925 </p>
            </i>
            <i class = "fab fa-whatsapp">
                <p> (+62) 8145065711 </p>
            </i>
        </div>
        <div id = "footer_menu">
                <a href="#home">Beranda</a>
                <a href="#gallery">Galeri</a>
                <a href="#contact">Kontak</a>
                <p></p>
                <a href="{{url('/dashboard')}}">Masuk Karyawan</a>
        </div>
        <div id = "footer_credits">
            <p><b>Website Toko Asri &#169; 2024,</b> Wildan Achmad Noorfikri</p>
        </div>
    </footer>
</body>
</html>
