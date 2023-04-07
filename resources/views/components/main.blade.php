<!DOCTYPE html>
<html lang="pl" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Drzewko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.css') }}">
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-md py-3" style="--bs-dark-rgb: 33,37,41;--bs-danger-rgb: 81,0,0;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="">
            <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><i class="fas fa-tree"></i></span><span>Drzewko</span></a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5">
            <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-5">
            <ul class="navbar-nav ms-auto">
                @auth

                        <li class="nav-item">
                            <div class="btn-group">
{{--                                <a class="btn btn-info" href="">Hej, {{ auth()->user()->name }}</a>--}}
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span> Konto
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <form class="inline" method="POST" action="{{ url('/logout') }}">
                                        @csrf
                                        <li>
                                            <button type="submit" class="dropdown-item">
                                                Wyloguj się
                                            </button>
                                        </li>
                                    </form>
                                </ul>
                            </div>

                @else
                    <li class="nav-item"><a class="btn btn-danger ms-md-2" role="button" href="{{ route('register') }}">Rejestracja</a></li>
                    <li class="nav-item"><a class="btn btn-info ms-md-2" role="button" href="{{ route('login') }}">Logowanie</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<section class="position-relative py-4 py-xl-5" id="main-s">
    <div class="container position-relative">
        <div class="row d-flex justify-content-center">
            <div class="mb-5">
                {{-- VIEW OUTPUT --}}
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
<footer class="text-center">
    <div class="container text-white py-4 py-lg-5">

        <p class="mb-0">2023 Struktura drzewiasta</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@stack('scripts')


</body>

</html>
