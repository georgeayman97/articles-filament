@if (filled($brand = filament()->getBrandName()))
    <div class="
    flex items-center justify-center
    fi-logo text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white
    py-2
     ">
        <svg  fill="none" width="60" height="60" viewBox="0 0 60 60" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <img src="{{ asset('images/mountain-view.svg') }}" width="60" height="60" alt="Mountain View Icon">
        </svg>
    </div>
@endif
