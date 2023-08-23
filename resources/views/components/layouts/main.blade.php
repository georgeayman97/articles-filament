@props([
    'title' => '',
    'siteName' => config('app.name'),
])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? "$title — " : '' }}{{ config('app.name') }}</title>


    @livewireStyles
</head>
<body class="bg-white">
<div class="flex flex-col min-h-screen">

    <main>
        {!! $slot ?? '' !!}
    </main>

    <div class="mt-16"></div>


</div>

@livewireScripts
</body>
</html>
