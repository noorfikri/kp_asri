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
                        <p>Harga: <strong>@toIDR($item->price)</strong></p>
                        <div class="badge-container">
                            <strong>Ukuran:</strong>
                            @php
                                $sizes = collect($item->stocks)->map(function($stock) { return $stock->size ? $stock->size->name : null; })->filter()->unique();
                            @endphp
                            @if($sizes->count())
                                @foreach($sizes as $sizeName)
                                    <span class="badge" style="background-color: var(--bottom-bar-color); color: var(--text-color);">{{ $sizeName }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                        <div class="badge-container">
                            <strong>Warna:</strong>
                            @php
                                $colours = collect($item->stocks)->map(function($stock) { return $stock->colour ? $stock->colour->name : null; })->filter()->unique();
                            @endphp
                            @if($colours->count())
                                @foreach($colours as $colourName)
                                    <span class="badge" style="background-color: var(--bottom-bar-color); color: var(--text-color);">{{ $colourName }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
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
