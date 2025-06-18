@extends('layouts.homepagelayout')

@section('content')
<main class="content">
    <article id="contact">
        <div class="content_desc">
            <h1 class="title">Hubungi Kami</h1>
            <p>Untuk kritik, saran, pertanyaan dan pesan maupun pesanan Anda dapat dilakukan pada form ini</p>
            <form id="contact-form" method="POST" action="{{ route('messages.store') }}" class="form styled-form" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="inputName" class="form-label">Nama</label>
                    <input type="text" id="inputName" name="name" class="form-control styled-input @error('name') is-invalid @enderror" placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputContact" class="form-label">Kontak yang bisa dihubungi</label>
                    <input type="text" id="inputContact" name="contact" class="form-control styled-input @error('contact') is-invalid @enderror" placeholder="Masukkan email atau nomor kontak Anda" value="{{ old('contact') }}" required>
                    @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="inputCategory" class="form-label">Kategori</label>
                        <select id="inputCategory" name="category" class="form-control styled-select @error('category') is-invalid @enderror" required>
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih kategori</option>
                            <option value="review" {{ old('category') == 'review' ? 'selected' : '' }}>Ulasan</option>
                            <option value="order" {{ old('category') == 'order' ? 'selected' : '' }}>Pesanan</option>
                            <option value="question" {{ old('category') == 'question' ? 'selected' : '' }}>Pertanyaan</option>
                            <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputSubject" class="form-label">Subjek</label>
                        <input type="text" id="inputSubject" name="subject" class="form-control styled-input @error('subject') is-invalid @enderror" placeholder="Masukkan subjek" value="{{ old('subject') }}" required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputMessage" class="form-label">Pesan</label>
                    <textarea id="inputMessage" name="message" class="form-control styled-textarea @error('message') is-invalid @enderror" rows="5" placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary styled-button">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </article>
</main>
@endsection
