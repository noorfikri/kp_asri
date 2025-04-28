@extends('layouts.homepagelayout')

@section('content')
<div class = "content">
    <article id = "home">
        <div id = "home_img" class = "content_img">
            <img src="assets/img/ASRI Interior.jpeg" alt="Interior Toko Asri Busana Muslim">
        </div>
        <div id = "home_desc" class = "content_desc">
            <h1 class = "title">Toko Asri Busana Muslim</h1>
            <p>
                Kami adalah toko baju busana muslim yang terletak pada tengah Kota, Kota Kediri.
                Kami menyediakan baju busana muslim baik untuk laki laki maupun perempuan. Selain
                busana muslim, kami juga menyediakan peralatan sholat, kurma dan air zam zam.
                Selain itu, kami juga menyediakan jasa pembuatan mahar nikah.
            </p>
        </div>
    </article>
    <article id = "address">
        <div id = "address_storefront_img" class = "content_img">
            <img src="assets/img/ASRI Front.jpeg" alt="Depan Toko Asri Busana Muslim">
        </div>
        <div id = "address_desc" class = "content_desc">
            <h1 class = "title">Alamat</h1>
            <p>
                Toko Asri berada tepat di tengah kota Kota Kediri, Beberapa ratus meter dari Stasiun
                Kota Kediri dan beberapa meter dari Hotel Grand Surya Kota Kediri.
                <br>
                <br>
                Jl. Raden Patah No.4, Kelurahan Kemasan, Kecamatan Kota, Kota Kediri, Jawa Timur

            </p>
        </div>
        <div id = "address_map_card" class = "card">
            <img id="address_map" src="assets/img/Map ASRI.PNG" alt="Map Lokasi Toko Asri Busana Muslim">
            <div class = "card_content">
                <h1>Lokasi Toko Asri</h1>
                <p>Jl. Raden Patah No.4, Kelurahan Kemasan, Kecamatan Kota, Kota Kediri</p>
            </div>
        </div>
    </article>
    <article id = "gallery">
        <div id = "gallery_desc" class = "content_desc">
            <h1 class = "title" id = "gallery_title">Galeri</h1>
            <p>
                Beberapa koleksi baju yang kami miliki diantaranya:
            </p>
            <div id="gallery_container" class = "card_container">
                <div id = "gallery_card_1" class = "card">
                    <img id="gallery_img_1" class = "card_img" src="assets/img/kolase sollu abu polos.jpg" alt="Sollu Jubah Pria Abu Abu">
                    <div class = "card_content">
                        <h1>Sollu <br> Jubah Pria <br> Warna Abu Abu</h1>
                    </div>
                </div>
                <div id = "gallery_card_2" class = "card">
                    <img id="gallery_img_2" class = "card_img" src="assets/img/kolase sollu biru polos.jpg" alt="Sollu Jubah Pria Biru">
                    <div class = "card_content">
                        <h1>Sollu <br> Jubah Pria <br> Warna Biru</h1>
                    </div>
                </div>
                <div id = "gallery_card_3" class = "card">
                    <img id="gallery_img_3" class = "card_img" src="assets/img/Al-Luthfi Pkstan Al-Ikhsan.jpg" alt="Al Luthfi Pakistan Al-Ikhsan Panjang Putih">
                    <div class = "card_content">
                        <h1>Al Luthfi <br> Pakistan Al-Ikhsan Panjang <br> Warna Putih</h1>
                    </div>
                </div>
                <div id = "gallery_card_4" class = "card">
                    <img id="gallery_img_4" class = "card_img" src="assets/img/Al-Luthfi Pkstan Idlib pdk.jpg" alt="Al Luthfi Pakistan Idlib Pendek Putih">
                    <div class = "card_content">
                        <h1>Al Luthfi <br> Pakistan Idlib Pendek <br> Warna Putih</h1>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article id = "review">
        <div id = "review_desc" class = "content_desc">
            <h1 class = "title">Ulasan</h1>
            <p>Beberapa ulasan yang dikirimkan oleh para pelanggan kami:</p>
            <div id="review_container" class = "card_container">
                <div id = "review_card_1" class = "card_review">
                    <div class = "card_header">
                        <img class = "card_profile_img" src="assets/img/profile pic placeholder.jpg" alt="Review Profile Image">
                        <div class = "card_header_info">
                            <h1 class = "username">Amir Budianto</h1>
                            <div class = "card_rating">
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_bad"> </div>
                            </div>
                        </div>
                    </div>
                    <div class = "card_content">
                        <blockquote>Pelayanannya bagus, namun pegawai tidak banyak</blockquote>
                    </div>
                </div>
                <div id = "review_card_2" class = "card_review">
                    <div class = "card_header">
                        <img class = "card_profile_img" src="assets/img/profile pic placeholder.jpg" alt="Review Profile Image">
                        <div class = "card_header_info">
                            <h1 class = "username">Cici Desiwati</h1>
                            <div class = "card_rating">
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                            </div>
                        </div>
                    </div>
                    <div class = "card_content">
                        <blockquote>Harga memuaskan</blockquote>
                    </div>
                </div>
                <div id = "review_card_3" class = "card_review">
                    <div class = "card_header">
                        <img class = "card_profile_img" src="assets/img/profile pic placeholder.jpg" alt="Review Profile Image">
                        <div class = "card_header_info">
                            <h1 class = "username">Eko Firmansyah</h1>
                            <div class = "card_rating">
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_bad"> </div>
                                <div class = "rating_bad"> </div>
                            </div>
                        </div>
                    </div>
                    <div class = "card_content">
                        <blockquote>Pelayanan lama jika toko sedang ramai</blockquote>
                    </div>
                </div>
                <div id = "review_card_4" class = "card_review">
                    <div class = "card_header">
                        <img class = "card_profile_img" src="assets/img/profile pic placeholder.jpg" alt="Review Profile Image">
                        <div class = "card_header_info">
                            <h1 class = "username">Gagah Hadimulyo</h1>
                            <div class = "card_rating">
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_bad"> </div>
                            </div>
                        </div>
                    </div>
                    <div class = "card_content">
                        <blockquote>Bagus</blockquote>
                    </div>
                </div>
                <div id = "review_card_5" class = "card_review">
                    <div class = "card_header">
                        <img class = "card_profile_img" src="assets/img/profile pic placeholder.jpg" alt="Review Profile Image">
                        <div class = "card_header_info">
                            <h1 class = "username">Ilham Jokokusumo</h1>
                            <div class = "card_rating">
                                <div class = "rating_good"> </div>
                                <div class = "rating_good"> </div>
                                <div class = "rating_bad"> </div>
                                <div class = "rating_bad"> </div>
                                <div class = "rating_bad"> </div>
                            </div>
                        </div>
                    </div>
                    <div class = "card_content">
                        <blockquote>Barang yang saya cari tidak tersedia</blockquote>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article id = "contact">
        <div id = "contact_desc" class = "content_desc">
            <h1 class = "title">Kontak</h1>
            <p>Hubungi kami di : </p>
            <ul>
                <li>
                    <i class = "fas fa-phone"></i>
                    <h1> (0354) 689925 </h1>
                </li>
                <li>
                    <i class = "fab fa-whatsapp"></i>
                    <h1> (+62) 8145065711 </h1>
                </li>
            </ul>
        </div>
    </article>
</div>
@endsection
