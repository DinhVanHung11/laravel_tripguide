@php
    $user = auth()->user();
    $storeConfig = App\Models\StoreConfiguration::where('id',1)->first();
@endphp

<div class="footer content">
    <div class="footer-form-subscribe rounded-2xl max-md:py-4 max-md:px-5 max-lg:py-8 max-lg:px-8 py-[62px] px-[90px] max-w-[81.25%] mx-auto relative z-20 mb-[-124px]" style="background:  url({{ asset('images/bg-footer.png') }}) no-repeat center center / cover;">
        <form class="flex max-md:flex-col max-md:gap-y-5 md:items-end justify-between gap-x-[150px] max-lg:gap-x-10 footer-form-contact">
            <div class="text-white">
                <h3 class="text-[44px] max-lg:text-3xl font-extrabold mb-4 max-md:mb-2 max-md:text-xl">Get our pro offers </h3>
                <p class="max-md:text-xs">Create a visual identity for your company, and an overall brand</p>
            </div>
            <div class="flex p-2 bg-white rounded w-[49.3%] max-md:w-full flex-shrink-0 justify-between">
                <input type="text" placeholder="Type your email here" name="email" class="w-full">
                <button class="py-4 px-[30px] rounded bg-[#353945] text-white font-medium">Subcribe</button>
            </div>
        </form>
    </div>
    <div class="bg-[#f4f5f6]">
        <div class="footer-info max-w-[1056px] mx-auto flex justify-between max-md:pt-[150px] pt-[224px] pb-[150px] max-lg:px-5">
            <div class="logo w-[24%] max-md:order-2">
                <a href="{{route('home')}}" class="flex items-center gap-x-2 mb-[18px]">
                    <img src="{{$storeConfig->image ?? 'https://images.unsplash.com/photo-1696352529048-5e5eb6076a96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80'}}" alt="">
                    <strong class="text-xl font-bold">{{$storeConfig->name ?? 'TripGuide'}}</strong>
                </a>
                <p class="text-[#84878B] max-md:hidden">
                    This is the team that specializes in
                    making sure in the find it a
                    your interior looks cool
                </p>
            </div>
            <div class="services footer-info-item">
                <h3 class="text-2xl font-medium mb-[18px] text-[#222529]">Services</h3>
                <ul class="flex flex-col gap-y-4">
                    <li class="font-medium text-[#84878B]">Travel Booking</li>
                    <li class="font-medium text-[#84878B]">Flight Booking</li>
                    <li class="font-medium text-[#84878B]">Car Booking</li>
                    <li class="font-medium text-[#84878B]">Fivestar Hotel</li>
                    <li class="font-medium text-[#84878B]">Traveling</li>
                </ul>
            </div>
            <div class="support footer-info-item">
                <h3 class="text-2xl font-medium mb-[18px] text-[#222529]">Support</h3>
                <ul class="flex flex-col gap-y-4">
                    <li class="font-medium text-[#84878B]">Account</li>
                    <li class="font-medium text-[#84878B]">Legal</li>
                    <li class="font-medium text-[#84878B]">Contact</li>
                    <li class="font-medium text-[#84878B]">Terms & Condition</li>
                    <li class="font-medium text-[#84878B]">Privacy Policy</li>
                </ul>
            </div>
            <div class="bussiness footer-info-item">
                <h3 class="text-2xl font-medium mb-[18px] text-[#222529]">Business</h3>
                <ul class="flex flex-col gap-y-4">
                    <li class="font-medium text-[#84878B]">Success</li>
                    <li class="font-medium text-[#84878B]">About Locato</li>
                    <li class="font-medium text-[#84878B]">Blog</li>
                    <li class="font-medium text-[#84878B]">Information</li>
                    <li class="font-medium text-[#84878B]">Travel Guide</li>
                </ul>
            </div>
        </div>
    </div>
</div>
