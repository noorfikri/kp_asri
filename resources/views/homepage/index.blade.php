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
    <article id = "review">
        <div id = "review_desc" class = "content_desc">
            <h1 class = "title">Ulasan</h1>
            <p>Beberapa ulasan yang dikirimkan oleh para pelanggan kami:</p>
            <div id="review_container" class = "card_container">
                @foreach ($reviews as $review)
                <div id = "review_card_1" class = "card_review">
                    <div class = "card_header">
                        <div class = "card_header_info">
                            <h1 class = "title">{{$review->subject}}</h1>
                        </div>
                    </div>
                    <div class = "card_content">
                        <blockquote>{{$review->message}}</blockquote>
                        <p class="username">-{{$review->name}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </article>
    <article id = "contact">
        <div id = "contact_desc" class = "content_desc">
            <h1 class = "title">Kontak</h1>
            <p>Hubungi kami di : </p>
            <p>Untuk kritik dan saran dapat dikirimkan <a href="{{url('contact')}}">Disini</a></p>
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
