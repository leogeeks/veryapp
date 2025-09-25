@props([
    'label' => null,
    'error' => null,
    'required' => false,
    'options' => [],
    'placeholder' => 'Select an option'
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
    
    <select 
        {{ $attributes->merge([
            'class' => 'block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm' . ($error ? ' border-red-300 focus:ring-red-500 focus:border-red-500' : '')
        ]) }}
    >
        @if($placeholder)
        <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $text)
        <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
    
    @if($error)
    <p class="text-sm text-red-600">{{ $error }}</p>
    @endif
</div>