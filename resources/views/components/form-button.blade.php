{{-- resources/views/components/form-button.blade.php --}}
@props(['type' => 'submit', 'variant' => 'primary'])

<button 
    type="{{ $type }}"
    {{ $attributes->class([
        'w-full py-2 px-4 rounded-md font-medium transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2',
        'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500' => $variant === 'primary',
        'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500' => $variant === 'secondary',
        'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500' => $variant === 'success',
    ]) }}
>
    {{ $slot }}
</button>