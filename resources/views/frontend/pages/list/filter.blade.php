<div class="block-filter w-[22.3%] flex-shrink-0">
    <h3 class="mb-3 text-lg font-medium">Search location or property</h3>
    <form action="{{ route('hotel.location.filter') }}" method="POST">
        <div class="relative flex items-center justify-between search-box location border border-[#E7ECF3] rounded-xl px-5">
            <input type="text" placeholder="Search location or property" class="!px-0 search-input !bg-transparent"
                data-url="{{ route('search.location.get') }}"
                value="{{isset($location) ? $location->name : ''}}"
            >
            <input type="hidden" name="location" class="search-value"
                value="{{isset($location) ? $location->id : ''}}"
            >
            <span class="icon-search">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.49512 13.4902C2.90796 13.4902 0 10.5823 0 6.99512C0 3.40796 2.90796 0.5 6.49512 0.5C10.0823 0.5 12.9902 3.40796 12.9902 6.99512C12.9902 8.49625 12.481 9.87844 11.6258 10.9784L15.9993 15.3518L14.8511 16.5L10.4776 12.1265C9.37779 12.9812 7.9959 13.4902 6.49512 13.4902ZM11.3657 6.99634C11.3657 9.68671 9.18476 11.8677 6.49439 11.8677C3.80402 11.8677 1.62305 9.68671 1.62305 6.99634C1.62305 4.30597 3.80402 2.125 6.49439 2.125C9.18476 2.125 11.3657 4.30597 11.3657 6.99634Z" fill="#B1B5C4"/>
                </svg>
            </span>
            <div class="absolute search-results rounded-2xl left-0 bottom-[-2px] w-[121%]"></div>
        </div>
    </form>
</div>
