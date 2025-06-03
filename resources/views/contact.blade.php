@extends('layouts.layout')

@section('title', 'Contact')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Contactez-nous / اتصل بنا</h1>
        <p class="text-center">
            Avant de nous contacter, visitez le
            <a href="{{ route('guide') }}" class="text-decoration-none" style="color: rgb(162, 80, 23);">Guide Étudiant</a>,
            ainsi que la
            <a href="{{ route('faq') }}" class="text-decoration-none" style="color: rgb(162, 80, 23);">Foire Aux Questions (F.A.Q.)</a>.<br>
            قبل مراسلتنا، المرجو التأكد من أن الجواب على تساؤلكم لا يوجد على صفحتي
            <a href="{{ route('guide') }}" class="text-decoration-none" style="color: rgb(162, 80, 23);">دليل الطالب</a>
            و
            <a href="{{ route('faq') }}" class="text-decoration-none" style="color: rgb(162, 80, 23);">أسئلة و أجوبة</a>.
        </p>

        <form action="{{ route('contact.submit') }}" method="POST" class="border p-4 rounded shadow-sm">
            @csrf

            <!-- Nom & Prénom -->
            <div class="mb-3">
                <label for="name" class="form-label">Nom & Prénom / الإسم و النسب *</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Entrez votre nom et prénom" required>
            </div>

            <!-- Adresse E-mail -->
            <div class="mb-3">
                <label for="email" class="form-label">Adresse E-mail / البريد الإلكتروني *</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse e-mail" required>
            </div>

            <!-- Objet -->
            <div class="mb-3">
                <label for="subject" class="form-label">Objet / الموضوع *</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Entrez l'objet de votre message" required>
            </div>

            <!-- Message -->
            <div class="mb-3">
                <label for="message" class="form-label">Message / نص الموضوع *</label>
                <textarea id="message" name="message" class="form-control" rows="5" placeholder="Écrivez votre message ici" required></textarea>
            </div>

            <!-- CAPTCHA -->
            <div class="mb-3">
                <label for="captcha" class="form-label">Captcha / كود التحقق</label>
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                @error('g-recaptcha-response')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn custom-btn">Envoyer / إرسال</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
