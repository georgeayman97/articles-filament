<x-layouts.main :title="$article->title">
    <x-banner >
        <div class="text-4xl text-white">
            <h1>
                {{ $article->title }}
                {{-- @isset($isPeekPreviewModal) [Preview] @endisset --}}
            </h1>
        </div>
    </x-banner>

    <x-container>
        <div class="prose mt-8 mx-auto text-black">
            @if ($article->content)
                <x-Blocks.paragraph :text="$article->content" />
            @endif
        </div>
    </x-container>
    <x-container>
        @if ($article->image)
            <x-Blocks.image :image="$article->image" />
        @endif
    </x-container>
</x-layouts.main>
