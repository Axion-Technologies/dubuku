<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/images/favicon/favicon-16x16.png">
    <title>Dubuku</title>
    @livewireStyles

    <!-- CSS -->
    <link rel="stylesheet" href="/static/css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="/static/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/static/css/app/custom.css">

    <!-- JS -->
    <script src="/static/js/lib/jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="container mt-5 pt-2">
        <div class="text-center">
            <img src="/static/images/project_management.png" class="img-fluid" alt="logo">
            <h1>Dubuku</h1>
        </div>
        <br>
