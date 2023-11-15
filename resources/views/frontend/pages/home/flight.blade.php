@php
use App\Http\Services\CategoryService;

$categoryService = new CategoryService;
$category = $categoryService->getCategoryByName('flight');
@endphp

<div class="home-flight home-category-content" data-category-id="{{$category->id}}">
    @include('frontend.pages.home.flight.best_place')
</div>
