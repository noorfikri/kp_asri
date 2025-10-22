@extends('layouts.homepagelayout')

@section('content')
<div class="content">
    <article id="gallery">
        <div id="gallery_desc" class="content_desc">
            <h1 class="title" id="gallery_title">Galeri</h1>
            <p>
                Beberapa koleksi barang yang tersedia di {{$storeInfo->name}}:
            </p>
            <div id="gallery_container" class="card_container">
                @forelse ($items as $item)
                <div class="card">
                    <img class="card_img" src="{{asset($item->image) }}" alt="{{ $item->name }}">
                    <div class="card_content">
                        <h1>{{ $item->name }}</h1>
                        <p>{{ $item->description }}</p>
                        <p>Harga: @toIDR($item->price)</p>
                    </div>
                </div>
                @empty
                <p>Belum Ada Barang Tersedia</p>
                @endforelse
            </div>
        </div>
    </article>
</div>
@endsection
