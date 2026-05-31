@props([
    'index' => 0,
])

<svg viewBox="0 0 360 72" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
    {{ $attributes }}>
    <path d="M0 52C72 16 145 2 219 8C275 12 322 28 360 52"
        stroke="url(#workMobileCurveFade{{ $index }})" stroke-width="3" stroke-linecap="round" />
    <defs>
        <linearGradient id="workMobileCurveFade{{ $index }}" x1="0" y1="36" x2="360" y2="36"
            gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#FFFDFB" />
            <stop offset="22%" stop-color="#E97A37" />
            <stop offset="78%" stop-color="#E97A37" />
            <stop offset="100%" stop-color="#FFFDFB" />
        </linearGradient>
    </defs>
</svg>
