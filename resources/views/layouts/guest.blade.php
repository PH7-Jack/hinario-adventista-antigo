<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hinario') }}</title>

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />

        <meta name="description" content="Hinário Adventista. Pesquise por hinos e louve ao Senhor.">

        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ config('app.name', 'Hinario') }}">
        <meta property="og:description" content="Hinário Adventista. Pesquise por hinos e louve ao Senhor.">
        <meta property="og:image" content="{{ asset('images/cover.png') }}">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="{{ asset('images/cover.png') }}">
        <meta property="twitter:domain" content="{{ parse_url(config('app.url'), PHP_URL_HOST) }}">
        <meta property="twitter:url" content="{{ config('app.url') }}">
        <meta name="twitter:title" content="{{ config('app.name', 'Hinario') }}">
        <meta name="twitter:description" content="Hinário Adventista. Pesquise por hinos e louve ao Senhor.">
        <meta name="twitter:image" content="{{ asset('images/cover.png') }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('dist/app.css') }}">
        <livewire:styles />

        <wireui:scripts />
        <script src="{{ mix('dist/app.js') }}" defer></script>

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>

    <body class="font-sans text-gray-900 antialiased bg-slate-100">
        <x-notifications />

        {{ $slot }}

        <livewire:scripts />
    </body>
</html>
