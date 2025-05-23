{{-- resources/views/components/form-input.blade.php --}}
@props(['label', 'name', 'type' => 'text', 'required' => false, 'placeholder' => ''])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) }}"
        {{ $attributes->class([
            'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent',
            'border-red-500' => $errors->has($name)
        ]) }}
        @if($required) required @endif
    >
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>