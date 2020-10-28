<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #202B33;
            color: #738491;
            font-family: "Open Sans";
            font-size: 16px;
            font-smoothing: antialiased;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div id="app">
    <Homepage
        :user-name='@json(auth()->user()->name)'
        :user-id='@json(auth()->user()->id)'
        :api-token='@json(auth()->user()->api_token)'
    ></Homepage>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
