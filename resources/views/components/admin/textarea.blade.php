@props([
    'label' => null,
    'error' => null,
    'required' => false,
    'placeholder' => null,
    'rows' => 3
])

<div class="space-y-1">
    @if($label)
    <label class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    
    <textarea 
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' => 'block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm' . ($error ? ' border-red-300 focus:ring-red-500 focus:border-red-500' : ''),
            'placeholder' => $placeholder
        ]) }}
    >{{ $slot }}</textarea>
    
    @if($error)
    <p class="text-sm text-red-600">{{ $error }}</p>
    @endif
</div>