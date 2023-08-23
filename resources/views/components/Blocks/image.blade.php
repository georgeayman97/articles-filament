@props([
    'image' => false,
    'url' => false,
    'alt' => false,
    'caption' => false,
    'ratio' => false,
])

@php
    $src = $image ? url($image) : $url;

    $ratioClass = \App\Filament\Blocks\Image::getRatioClass($ratio ?: '2-1');
@endphp

@if ($src && $caption)
    <figure>
        <img
            class="w-full {{ $ratioClass }} object-cover object-center"
            src="{{ $src }}"
            @if ($alt) alt="{{ $alt }}" @endif
        >
        <figcaption>{{ $caption }}</figcaption>
    </figure>
@elseif ($src)
    <img
        class="w-full {{ $ratioClass }}"
        src="{{ $src }}"
        width="600"
        height="600"
        @if ($alt) alt="{{ $alt }}" @endif
    >
@endif
