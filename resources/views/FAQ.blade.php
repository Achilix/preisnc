@extends('layouts.layout')

@section('title', 'Foire Aux Questions (F.A.Q.)')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Foire Aux Questions (F.A.Q.) / الأسئلة الشائعة</h1>
        <p class="text-center">
            Avant de nous contacter, veuillez chercher la réponse à votre question dans la liste ci-dessous.<br>
            قبل الاتصال بنا، يرجى البحث على جواب لسؤالكم في القائمة أسفله.
        </p>

        <div class="accordion" id="faqAccordion">
            <!-- Section 1: Conditions d'inscription -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        Conditions d'inscription / شروط التسجيل
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>عملية تسجيل الطلية تتم عبر مرحلتين:</p>
                        <ul>
                            <li>المرحلة الأولى: إتمام التسجيل القبلي عبر الموقع الالكتروني وإدخال كل المعطيات المطلوبة.</li>
                            <li>المرحلة الثانية: إيداع ملفات التسجيل بالمؤسسة المختارة.</li>
                        </ul>
                        <p>L'opération de préinscription passe par deux phases:</p>
                        <ul>
                            <li>La première phase: Finalisation de la préinscription sur la plateforme en introduisant toutes les informations nécessaires.</li>
                            <li>La deuxième phase: Dépôt de dossier d'inscription à l'établissement choisi.</li>
                        </ul>
                        <p>
                            إذا لم تتمكنوا من التسجيل بإحدى المؤسسات أو بأحد المسالك، أو لم تظهر ضمن الاختيارات المتوفرة على الموقع، فذلك لأن عملية التسجيل القبلي تخضع لعدة شروط من ضمنها، التوزيع الجغرافي ونوع الباكالوريا المحصل عليها.
                        </p>
                        <p>
                            Et si vous ne pouvez pas commencer votre préinscription, c'est parce que vous n'appartenez pas au bassin de recrutement de l'université, la région de Marrakech, ou bien vous n'êtes pas admis à aucun concours des établissements à accès régulé, ou bien votre série de baccalauréat limite votre accès aux filières de l'université.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 2: Inscription des anciens bacheliers -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        Inscription des anciens bacheliers / تسجيل حملة الباكالوريا ما قبل 2022
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>
                            هذا الموقع يسمح لك بالتسجيل المسبق فقط إذا تم إبلاغه بقرار قبول طلبك من قبل المؤسسة التي قمت بتوجيه الطلب لها.
                        </p>
                        <p>
                            La plateforme vous permet de faire une préinscription, seulement si la décision d'acceptation de votre demande nous a été communiquée par l'établissement auquel vous avez postulé la demande d'inscription.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 3: Comment s'inscrire ? -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        Comment s'inscrire ? / كيفية التسجيل
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>
                            المرجو مراجعة دليل الطالب على الرابط التالي: <a href="{{ route('guide') }}">إضغط هنا</a>.
                        </p>
                        <p>
                            Un guide sur ce lien vous explique la procédure de préinscription: <a href="{{ route('guide') }}">Cliquez ici</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 4: Changer de filière -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading4">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                        Changer de filière / تغيير المسلك
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>
                            يتم تغيير المسلك المختار من خلال تسجيل الدخول إلى حسابكم، وبالمرحلة الخامسة من التسجيل القبلي يمكنكم تغيير اختياركم.
                        </p>
                        <p>
                            Pour changer la filière, il vous suffit de vous connecter sur votre compte et d'aller à l'étape 5 où vous pouvez changer votre filière.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 5: Compléter/Modifier votre préinscription -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading5">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                        Compléter/Modifier votre préinscription / تكملة أو تعديل معلوماتكم
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>
                            لتكملة أو تعديل معلوماتكم، يجب أن تقومو بتسجيل الدخول بإستعمال رقمكم الوطني، وكلمة المرور التي اخترتموها، على هذا <a href="/connexion">الرابط</a>.
                        </p>
                        <p>
                            Pour compléter ou modifier votre préinscription, vous devez vous connecter avec votre CNE, et le mot de passe que vous avez choisi sur ce <a href="/connexion">lien</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 6: Autre question -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading6">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                        Autre question / سؤال آخر
                    </button>
                </h2>
                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>
                            للاتصال بنا إذا لم تجدوا جوابا على سؤالكم في الائحة أعلاه، أنقرو <a href="{{ route('contact') }}">هنا</a>.
                        </p>
                        <p>
                            Si vous n'avez pas trouvé une réponse à votre question ci-dessus, cliquez <a href="{{ route('contact') }}">ici</a> pour nous contacter.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
