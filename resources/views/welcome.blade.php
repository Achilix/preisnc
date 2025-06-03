<!-- filepath: c:\Users\hatim\OneDrive\Desktop\campus_preinscription\resources\views\welcome.blade.php -->
@extends('layouts.layout')

@section('title', 'Accueil')

@section('content')
    <!-- Main Content -->
    <div class="container text-center mt-5">

        <!-- Added Content -->
        <div class="d-flex justify-content-between text-start">
            <div class="w-50 pe-3">
                <p>
                    <strong>Préinscription</strong><br>
                    - Si vous avez un Baccalauréat 2023 ou 2024 et Afin de débuter votre préinscription veuillez choisir l'origine de votre Bac.<br>
                    - Si vous avez un Baccalauréat avant 2023 Vous devez déposer une demande d'inscription à l'établissement concernée.<br>
                    - Si vous avez des questions, vous pouvez visiter le guide étudiant ainsi que la Foire Aux Questions (F.A.Q.) mis à votre disposition.<br>
                    - La préinscription est ouverte jusqu'au <strong>2024-11-30</strong>.
                </p>
            </div>
            <div class="w-50 ps-3">
                <p>
                    <strong>التسجيل القبلي</strong><br>
                    إذا كان لديك بكالوريا 2024 او 2023 و من أجل بدأ التسجيل القبلي المرجو اختيار نوع البكالوريا التي بحوزتكم-<br>
                    حاملي باكالوريا ما قبل 2023 يتم وضع طلبات التسجيل بالمؤسسة المعنية بالتكوين المطلوب -<br>
                    إذا كان لديكم أي أسئلة، يمكنكم زيارة دليل الطالب و صفحة أسئلة وأجوبة الموضوعة رهن إشارتكم-<br>
                    التسجيل القبلي سيكون مفتوحًا إلى غاية <strong>2024-11-30</strong> -
                </p>
            </div>
        </div>

        @if(Auth::check())
            @php
                $step = Auth::user()->step ?? 1;
                $stepRoute = match($step) {
                    1 => route('Etape1'),
                    2 => route('Etape2'),
                    3 => route('Etape3'),
                    4 => route('Etape4'),
                    5 => route('Etape5'),
                    6 => route('Etape6'),
                    default => route('Etape1'),
                };
            @endphp
            <a href="{{ $stepRoute }}" class="btn btn-primary btn-lg mt-4" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">Préinscrire</a>
        @else
            <a href="{{ route('pre-register.form') }}" class="btn btn-primary btn-lg mt-4" style="background-color: rgb(162, 80, 23); border-color: rgb(162, 80, 23);">Préinscrire</a>
        @endif
    </div>
@endsection
