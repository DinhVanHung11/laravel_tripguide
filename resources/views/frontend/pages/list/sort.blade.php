<div class="absolute right-0 -top-16 toolbars-sort">
    <div class="relative flex items-center justify-between px-6 py-2 bg-white border max-lg:gap-x-5 rounded-3xl gap-x-10 sort-title max-lg:text-sm">
        <span class="sort-selected">Sort: {{ $sortType }}</span>
        <span>
            <img src="{{ asset('images/icon-down.svg') }}" alt="">
        </span>
        <ul class="absolute left-0 w-full px-6 transition-all bg-white shadow-lg sort-list">
            <li class="py-2 sort-item">
                <a href="{{ route('hotel.list', ['location' => Str::slug($location->name)]) }}">Default</a>
            </li>
            <li class="py-2 sort-item">
                <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}">Price: High To Low</a>
            </li>
            <li class="py-2 sort-item">
                <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}">Price: Low To High</a>
            </li>
        </ul>
    </div>
</div>
