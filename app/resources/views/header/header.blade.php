<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dubuku - Project management application</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/static/css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="/static/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/static/css/app/custom.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/images/favicon/favicon-16x16.png">
    <!-- JS -->
    <script src="/static/js/lib/jquery-3.4.1.min.js"></script>    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Trix editor -->
    <link rel="stylesheet" href="/static/css/lib/trix.min.css" crossorigin="anonymous">
    <script src="/static/js/lib/trix.umd.min.js" crossorigin="anonymous"></script>
    @livewireStyles
</head>
<body>
    <nav class="navbar navbar-expand-md bg-white navbar-light border-bottom box-shadow fixed-top">
        <div class="container">
            <a class="navbar-brand ms-2 me-auto" href="/home">
                <img class="img-fluid" src="/static/images/favicon/favicon-32x32.png" alt="logo">&nbsp
                Dubuku
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto menu">
                    @if (auth()->user()->user_role === \App\Models\Users::ROLE_ADMIN)
                    <li class="nav-item me-5">
                        <a class="nav-link text-dark" href="/admin"><i class="fa fa-user-shield logo" aria-hidden="true"></i>&nbsp Admin</a>
                    </li>
                    @endif
                    <li class="nav-item me-5">
                        <a class="nav-link text-dark" href="/profile"><i class="fa fa-user logo" aria-hidden="true"></i>&nbsp Profile </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link text-dark" href="/logout"><i class="fa fa-sign-out logo" aria-hidden="true"></i>&nbsp Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>
    <div class="container mt-5">