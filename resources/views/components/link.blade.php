@php
    $classes = "outline-0 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500";
@endphp
<div>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</div>