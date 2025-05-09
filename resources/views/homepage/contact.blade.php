@extends('layouts.homepagelayout')

@section('content')
<main class="content">
    <article id="contact">
        <div class="content_desc">
            <h1 class="title">Hubungi Kami</h1>
            <p>Untuk kritik, saran, pertanyaan dan pesan maupum pesanan anda dapat lakukan pada form ini</p>
            <form id="contact-form" method="POST" action="{{route('messages.store')}}" class="form styled-form">
                @csrf
                <div class="form-group">
                    <label for="inputName" class="form-label">Nama</label>
                    <input type="text" id="inputName" name="name" class="form-control styled-input" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="form-group">
                    <label for="inputContact" class="form-label">Kontak yang bisa dihubungi</label>
                    <input type="text" id="inputContact" name="contact" class="form-control styled-input" placeholder="Masukkan email atau nomor kontak Anda" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputCategory" class="form-label">Kategori</label>
                        <select id="inputCategory" name="category" class="form-control styled-select" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="review">Ulasan</option>
                            <option value="order">Pesanan</option>
                            <option value="question">Pertanyaan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputSubject" class="form-label">Subjek</label>
                        <input type="text" id="inputSubject" name="subject" class="form-control styled-input" placeholder="Masukkan subjek" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMessage" class="form-label">Pesan</label>
                    <textarea id="inputMessage" name="message" class="form-control styled-textarea" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary styled-button" value="Kirim Pesan">
                </div>
            </form>
        </div>
    </article>
</main>
@endsection
