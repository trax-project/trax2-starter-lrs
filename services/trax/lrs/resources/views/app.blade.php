<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <meta name="base-url" content="{{ url('/') }}">
    
    <!-- Scripts -->
    <script src="{{ url('/') . mix('js/lrs.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/lrs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/highlightjs.min.css') }}" rel="stylesheet">

    <!-- Fonts and icons -->
    <link href="{{ asset('fonts/poppins-font.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/nucleo-icons.css') }}" rel="stylesheet" />

    <!-- Brand -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>
        TRAX LRS• The Progressive LRS
    </title>

</head>
<body>
    <div id="app"></div>
</body>
</html>
