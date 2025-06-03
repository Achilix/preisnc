<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Campus')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Universite_Cadi_Ayyad.png') }}">
    <style>
        body {
            background-color: rgb(255, 255, 255); /* White */
            color: black; /* Default text color */
        }

        .navbar {
            background-color: rgb(255, 255, 255); /* White */
            transition: top 0.3s ease, height 0.3s ease; /* Smooth transition for sticky effect */
            z-index: 1000;
        }

        .navbar.sticky {
            position: fixed;
            top: 0;
            width: 100%;
            height: 60px; /* Adjust navbar height when sticky */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow for sticky navbar */
        }

        .navbar-brand img {
            height: 80px; /* Default image size (2x larger) */
            transition: height 0.3s ease; /* Smooth transition for image resizing */
        }

        .navbar.sticky .navbar-brand img {
            height: 40px; /* Shrink image size when sticky */
        }

        .navbar .nav-link, .navbar .btn-outline-primary {
            color: rgb(162, 80, 23); /* Brown-red */
        }

        .navbar .nav-link {
            color: rgb(162, 80, 23);
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            color: rgb(162, 80, 23); /* Keep text brown-red */
            background-color: #fff; /* White background */
            border-bottom: 2px solid rgb(162, 80, 23); /* Optional underline effect */
            border-radius: 5px;
            padding: 5px 10px;
        }

        .navbar .btn-outline-primary {
            color: rgb(162, 80, 23);
            border-color: rgb(162, 80, 23);
            background-color: #fff;
        }

        .navbar .btn-outline-primary:hover,
        .navbar .btn-outline-primary:focus {
            background-color: rgb(162, 80, 23); /* Brown-red background */
            color: #fff; /* White text */
            border-color: rgb(140, 70, 20);
        }

        .dropdown-menu {
            background-color: #fff;
        }

        .dropdown-item {
            color: rgb(162, 80, 23);
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: rgb(162, 80, 23);
            color: #fff;
        }

        .custom-btn {
            background-color: rgb(162, 80, 23); /* Original button color */
            color: white; /* Text color */
            border: none; /* Remove border */
            transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
        }

        .custom-btn:hover {
            background-color: rgb(140, 70, 20); /* Darker shade on hover */
            color: white; /* Keep text color white */
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand">
                <img src="{{ asset('images/Universite_Cadi_Ayyad.png') }}" alt="Université Cadi Ayyad">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guide') }}">Guide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mentionslegales') }}">Mentions légales</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="btn btn-outline-primary dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ trim(Auth::user()->prenom_fr_etu . ' ' . Auth::user()->nom_fr_etu) ?: Auth::user()->email_etu }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @php
        $etapeRoutes = ['Etape1', 'Etape2', 'Etape3', 'Etape4', 'Etape5', 'Etape6'];
    @endphp

    @auth
        @if(in_array(Route::currentRouteName(), $etapeRoutes))
            @php
                $userStep = Auth::user()->step ?? 1;
                $currentRoute = Route::currentRouteName();
                $steps = [
                    1 => ['label' => 'Étape 1', 'route' => route('Etape1')],
                    2 => ['label' => 'Étape 2', 'route' => route('Etape2')],
                    3 => ['label' => 'Étape 3', 'route' => route('Etape3')],
                    4 => ['label' => 'Étape 4', 'route' => route('Etape4')],
                    5 => ['label' => 'Étape 5', 'route' => route('Etape5')],
                    6 => ['label' => 'Étape 6', 'route' => route('Etape6')],
                ];
            @endphp
            <div class="container my-4">
                <div class="d-flex justify-content-center align-items-center">
                    @foreach($steps as $stepNum => $step)
                        <div class="text-center" style="min-width: 90px;">
                            @if($userStep > $stepNum)
                                <a href="{{ $step['route'] }}"
                                   class="rounded-circle"
                                   style="display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; background: rgb(162,80,23); border: 3px solid rgb(162,80,23); color: #fff; font-size: 1.3em; font-weight: bold; text-decoration: none;">
                                    &#10003;
                                </a>
                            @elseif($userStep == $stepNum)
                                <a href="{{ $step['route'] }}"
                                   class="rounded-circle"
                                   style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: #fff; border: 4px solid rgb(162,80,23); color: rgb(162,80,23); font-size: 1.3em; font-weight: bold; box-shadow: 0 0 8px rgba(162,80,23,0.15); text-decoration: none;">
                                    {{ $stepNum }}
                                </a>
                            @else
                                <span class="rounded-circle"
                                      style="display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; background: #f3f3f3; border: 2px solid #ccc; color: #aaa; font-size: 1.3em; font-weight: bold; cursor: not-allowed;">
                                {{ $stepNum }}
                            </span>
                            @endif
                            <div style="font-size: 0.9em; margin-top: 6px; color: {{ $userStep >= $stepNum ? 'rgb(162,80,23)' : '#aaa' }};">
                                {{ $step['label'] }}
                            </div>
                        </div>
                        @if($stepNum < count($steps))
                            <div style="flex: 1 1 0; height: 3px; background: {{ $userStep > $stepNum ? 'rgb(162,80,23)' : '#ccc' }}; margin: 0 8px;"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endauth

    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
