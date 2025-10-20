@if ($show)
<div class="text-sm text-gray-500 flex items-center space-x-1">
    <a href="{{ route('user.home') }}" class="hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
        </svg>
    </a>

    @foreach ($items as $key => $item)
        <span class="mx-1">›</span>
        @if ($loop->last)
            <span class="text-gray-800 font-medium">{{ $item['label'] }}</span>
        @else
            <a href="{{ $item['url'] }}" class="hover:text-gray-700">{{ $item['label'] }}</a>
        @endif
    @endforeach
</div>
@endif

