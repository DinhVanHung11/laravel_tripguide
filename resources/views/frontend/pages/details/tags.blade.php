<div class="flex items-center mb-5 hotel-tags gap-x-4">
    <div class="px-4 py-[1px] text-sm leading-6 text-[#38B245] relative w-max rounded-md overflow-hidden font-medium">
        <span>{{ $hotel->rating }}</span>
        <span class="absolute w-full h-full bg-[#38B245] left-0 top-0 bg-opacity-[0.15]"></span>
    </div>

    @if ($hotel->tags && count($hotel->tags) > 0)
        @foreach ($hotel->tags as $tag)
            <div class="relative px-4 py-[1px] overflow-hidden text-sm font-medium leading-6 rounded-md w-max" style="color: #{{ $tag->color }}">
                <span class="capitalize">{{ $tag->name }}</span>
                <span class="absolute w-full h-full left-0 top-0 opacity-[0.15]" style="background: #{{ $tag->color }};"></span>
            </div>
        @endforeach
    @endif

    <div>
        <img src="{{ asset('images/icon-review.svg') }}" alt="">
    </div>
</div>
