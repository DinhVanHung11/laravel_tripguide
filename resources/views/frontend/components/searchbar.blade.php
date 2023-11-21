@php
use App\Http\Services\CategoryService;

$categoryService = new CategoryService;
$categories = $categoryService->getParents();
@endphp

@if (!isset($hideSearchBar))
    <section class="block-search max-w-[1440px] mx-auto">
        @if (!isset($hiddenBgHeader))
            <img class="max-md:hidden" src="{{asset('images/header-bg.jpg')}}" alt="">
            <img class="object-cover w-full md:hidden h-[350px]" src="{{asset('images/header-bg-mb.jpg')}}" alt="">
        @endif

        <div class="w-full lg:w-[81.25%] max-lg:px-5 mx-auto {{!isset($hiddenBgHeader) ? 'mt-[-100px]' : 'mt-14' }} relative z-10">
            <form action="{{ route('hotel.location.filter') }}" class="flex items-end justify-between w-full p-5 bg-white shadow-md search-content rounded-2xl lg:py-7 lg:px-14 max-md:flex-wrap max-lg:gap-x-5" method="POST">
                <div class="w-full search-main">
                    <div class="flex items-center justify-between search-top max-md:flex-wrap {{isset($hiddenBgHeader) ? 'no-category' : ''}}">
                        @if (!isset($hiddenBgHeader))
                            <div class="search-cate max-md:w-full">
                                <ul class="flex items-center search-cate-list max-lg:justify-between lg:gap-x-8">
                                    @if (count($categories) > 0)
                                        @foreach ( $categories as $category)
                                            <li class="text-sm cursor-pointer search-cate-item" data-category-id="{{$category->id}}">
                                                {!!$category->image!!}
                                                {{$category->name}}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="flex items-center font-medium opacity-0 max-sm:hidden search-options gap-x-5 lg:gap-x-6 lg:text-lg">
                                <div class="search-round search-option search-option-wrap">
                                    <div class="search-option-label"></div>
                                    <span>Round trip</span>
                                    <i class="fas fa-chevron-down text-[#84878B] text-xs"></i>
                                </div>
                                <div class="search-person search-option search-option-wrap">
                                    <span>1 passenger</span>
                                    <i class="fas fa-chevron-down text-[#84878B] text-xs"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex w-full search-bottom lg:gap-x-2 gap-[10px]">
                        <div class="relative search-box location">
                            <label for="">Location</label>
                            <input type="text" placeholder="Where are you from?" class="search-input"
                                data-url="{{ route('search.location.get') }}"
                                value="{{isset($location) ? $location->name : ''}}"
                            >
                            <input type="hidden" name="location" class="search-value"
                                value="{{isset($location) ? $location->id : ''}}"
                            >
                            <div class="absolute search-results rounded-2xl left-0 bottom-[-2px] w-[121%]"></div>
                        </div>
                        <div class="search-box location">
                            <label for="">Check in</label>
                            <input type="date" name="check_in" value="{{isset($checkin) ? $checkin : ''}}">
                        </div>
                        <div class="search-box location">
                            <label for="">Check out</label>
                            <input type="date" name="check_out" value="{{isset($checkout) ? $checkout : ''}}">
                        </div>
                    </div>
                </div>
                <button id="action-search"  class="!h-auto flex-shrink-0 button-primary max-md:w-full text-xl py-[11px] lg:py-5 px-10 lg:ml-12 max-lg:mt-3">
                    Search
                </button>
                @csrf
            </form>
        </div>
    </section>
@endif
