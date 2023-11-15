<div class="mb-10 hotel-image">
    @if (count($hotel->images) > 0)
        <div class="flex overflow-hidden gap-x-5 rounded-xl">
            <div class="w-[61%] h-[630px]">
                <img class="object-cover h-full feature-image" src="{{ $hotel->image }}" alt="">
            </div>
            <div class="flex flex-col flex-1 gap-y-5">
                @php
                    $images = $hotel->images;
                @endphp
                @if (count($images) == 3)
                    @for ($i = 0; $i < 3; $i++)
                        <img src="{{ $images[$i]->image }}" class="h-[196.67px] object-cover" alt="">
                    @endfor
                @elseif(count($images) == 2)
                    @for ($i = 0; $i < 2; $i++)
                        <img src="{{ $images[$i]->image }}" class="h-[305px] object-cover" alt="">
                    @endfor
                @elseif(count($images) == 2)
                    <img src="{{ $images[$i]->image }}" class="object-cover" alt="">
                @endif
            </div>
        </div>
    @elseif($hotel->image)
        <span class="w-full h-[630px] rounded-xl block">
            <img class="object-cover w-full h-full rounded-xl feature-image" src="{{ $hotel->image }}" alt="">
        </span>
    @endif
</div>
