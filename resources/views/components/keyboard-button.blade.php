@props(['label' => null])

<button {{ $attributes->class([
        'w-14 h-14 rounded-full flex items-center justify-center mx-auto',
        'border border-gray-200 bg-white text-gray-400 shadow-md',
        'transition-all ease-in-out duration-200',
        'hover:shadow-indigo focus:shadow-indigo focus:outline-none'
    ])->merge([
        'type' => 'button',
    ]) }}>
    {{ $label ?? $slot }}
</button>
