@props(['block'])
@dd($block)
@component("components.blocks.{$block['type']}", $block['data'] ?? []) @endcomponent
