<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .line_height {
            height: 5px;
        }
        div#home_banner {
            height: 20vw;
            min-height: 100%;
            background-image: url({{ asset('/upload/images/system/home_banner.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="line_height"></div>
    <div id="home_banner"></div>
    <hr>
    <div id="app">
        <app></app>
    </div>
</div>


<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
