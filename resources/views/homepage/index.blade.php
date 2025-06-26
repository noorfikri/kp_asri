@extends('layouts.homepagelayout')

@section('content')
<div class = "content">
    <article id = "home">
        <div id = "home_img" class = "content_img">
            <img src="assets/img/ASRI Interior.jpeg" alt="Interior Toko Asri Busana Muslim">
        </div>
        <div id = "home_desc" class = "content_desc">
            <h1 class = "title">{{$storeInfo->name}}</h1>
            <p>
                {{$storeInfo->description}}
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
                {{$storeInfo->address}}

            </p>
        </div>
        <div id = "address_map_card" class = "card">
            <img id="address_map" src="assets/img/Map ASRI.PNG" alt="Map Lokasi Toko Asri Busana Muslim">
            <div class = "card_content">
                <h1>Lokasi {{$storeInfo->name}}</h1>
                <p>{{$storeInfo->address}}</p>
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
                    <h1> {{$storeInfo->phone}} </h1>
                </li>
                <li>
                    <i class = "fab fa-whatsapp"></i>
                    <h1> {{$storeInfo->whatsapp}} </h1>
                </li>
            </ul>
        </div>
    </article>
</div>
@endsection
