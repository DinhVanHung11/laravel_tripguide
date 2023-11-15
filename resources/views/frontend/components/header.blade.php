@php
    $storeConfig = App\Models\StoreConfiguration::where('id',1)->first();
    $user = auth()->user();
@endphp
<div class="shadow-md header content">
    <div class="header-top">
        <div class="header-logo logo">
            <a href="{{route('home')}}" class="">
                <img src="{{$storeConfig->image ?? 'https://images.unsplash.com/photo-1696352529048-5e5eb6076a96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80'}}" alt="">
                <strong>{{$storeConfig->name ?? 'TripGuide'}}</strong>
            </a>
        </div>
        <div class="relative header-right">
            <div class="header-action">
                <span class="price-type">USD</span>
                <img src="{{asset('images/icon-flag.svg')}}" alt="">
                <div class="header-noti">
                    <img src="{{asset('images/icon-notification.svg')}}" alt="">
                    <span>0</span>
                </div>
            </div>
            <div class="header-profile {{ $user ? 'user-logined' : ''}}">
                @if ($user)
                    <a href="{{route('user.account.me')}}">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{$user->image ?? asset('images/avatar-empty.png')}}" alt="">
                    </a>
                    <span class="visible-xl">{{$user->name}}</span>
                    <img class="visible-xl" src="{{asset('images/icon-dropdown.svg')}}" alt="">
                @else
                    <a class="authorization-link" href="#modal-authorization" rel="modal:open">
                        <img class="avatar" src="{{asset('images/icon-avatar-empty.svg')}}" alt="">
                    </a>
                @endif
            </div>
            @if ($user)
                <div class="absolute -bottom-4 right-0 translate-y-full rounded-2xl p-5 bg-white header-account-dropdown w-[238px] shadow-[0_6px_30px_rgba(0,0,0,0.3)] z-20">
                    <ul class="flex flex-col header-account-links gap-y-5 text-[16px]">
                        <li class="header-account-link">
                            <a href="{{route('user.account.me')}}" class="flex items-center gap-x-2">
                                <img src="{{asset('images/icon-account-profile.svg')}}" alt="">
                                My Profile
                            </a>
                        </li>
                        <li class="header-account-link">
                            <a href="{{route('user.booking.index')}}" class="flex items-center gap-x-2">
                                <img src="{{asset('images/icon-account-booking.svg')}}" alt="">
                                Bookings
                            </a>
                        </li>
                        <li class="header-account-link">
                            <a href="{{route('logout')}}" class="flex items-center gap-x-2">
                                <img src="{{asset('images/icon-account-signout.svg')}}" alt="">
                                Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
