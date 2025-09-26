@props(['padding' => 'p-6'])

<div {{ $attributes->merge(['class' => 'bg-white shadow rounded-lg']) }}>
    @if(isset($header))
    <div class="px-6 py-4 border-b border-gray-200">
        {{ $header }}
    </div>
    @endif
    
    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
        {{ $footer }}
    </div>
    @endif
</div>