@php
use App\Http\Services\CategoryService;

$categoryService = new CategoryService;
$category = $categoryService->getCategoryByName('hotel');
@endphp

<div class="home-hotel home-category-content mt-11" data-category-id="{{$category->id}}">
    @include('frontend.pages.home.hotel.best_place')
    @include('frontend.pages.home.hotel.feature_destination')
    @include('frontend.pages.home.hotel.top_tour')
    @include('frontend.pages.home.hotel.explore')
    @include('frontend.pages.home.hotel.trending_city')
    @include('frontend.pages.home.hotel.travel')
</div>
