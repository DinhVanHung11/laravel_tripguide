@extends('main')

@php
    $rangeCompleted = $userHelper->getRangeCompleted($user);
@endphp

@section('frontent.main')
    <div class="my-profile lg:flex max-w-[1200px] lg:px-[15px] mx-auto lg:gap-x-8 py-11">
        <div class="col-left lg:w-[31%] max-lg:mb-[30px]">
            <form action="{{route('user.account.update', $user->id)}}" method="POST" enctype="multipart/form-data" class="form-account-update p-8 bg-white lg:shadow-md border lg:border-2 border[#F4F5F6] account-short-info rounded-2xl">
                <div class="mb-6 text-center account-short-info-top">
                    <div class="mb-5 account-image">
                        <label for="file-input-circle" class="input-file-label cursor-pointer w-[170px] h-[170px] mx-auto block relative">
                            <a href="{{$user->image}}" target="_blank">
                                <img class="object-cover w-full h-full rounded-full" src="{{$user->image ?? asset('images/avatar-empty.png')}}"/>
                            </a>
                            <span class="flex items-center justify-center absolute bottom-1 right-2 w-10 h-10 border-2
                            border-[#E7ECF3 ] rounded-full bg-[#F4F5F6]">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.361882 13.0856L0.944688 10.4629C1.07741 9.86567 1.3777 9.31864 1.81033 8.88601L9.73065 0.96569C10.987 -0.290645 13.0239 -0.290648 14.2802 0.965688L15.3605 2.04593C16.6168 3.30227 16.6168 5.33919 15.3605 6.59552L7.44017 14.5158C7.00754 14.9485 6.46051 15.2488 5.86325 15.3815L3.24062 15.9643C1.51669 16.3474 -0.0212144 14.8095 0.361882 13.0856ZM2.51491 10.8119L1.9321 13.4345C1.8044 14.0091 2.31704 14.5218 2.89168 14.3941L5.51431 13.8113C5.80151 13.7474 6.06548 13.6061 6.27769 13.403L2.92319 10.0485C2.72005 10.2607 2.57873 10.5247 2.51491 10.8119ZM4.06032 8.91082L7.41535 12.2659L11.9078 7.77342L8.55275 4.41838L4.06032 8.91082ZM14.2231 5.45812L13.0452 6.63602L9.69015 3.28098L10.868 2.10309C11.4962 1.47492 12.5147 1.47492 13.1428 2.10309L14.2231 3.18333C14.8513 3.8115 14.8513 4.82996 14.2231 5.45812Z" fill="#777E91"/>
                                    </svg>
                            </span>
                        </label>
                        <input id="file-input-circle" class="hidden" type="file"/>
                        <input type="hidden" name="image" value="{{$user->image}}" id="input-image">
                    </div>
                    <h3 class="text-[34px] font-bold mb-5 account-name">{{$user->name}}</h3>
                    <input type="text" class="w-full text-[34px] font-bold mb-5 account-name-input hidden" value="{{$user->name}}" name="name">
                    <div class="flex items-center account-verify gap-x-3 bg-[#f4f5f6] rounded-[32px] w-max mx-auto py-2 px-7">
                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 5L5.5 9L13.5 1" stroke="#777E91" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Indentity verified</span>
                    </div>
                </div>
                <div class="text-sm font-medium account-short-info-bottom py-7 border-t-2 border-[#F5F6F7]">
                    <div class="flex items-center justify-between mb-4 account-address">
                        <label for="">From</label>
                        <span class="text-[#84878B]">{{$user->country}}</span>
                        {{-- <input type="text" placeholder="" value="United State" name="country"> --}}
                    </div>
                    <div class="flex items-center justify-between account-address">
                        <label for="">Member Since</label>
                        <span class="text-[#84878B]">{{$userHelper->formatDate($user->created_at)}}</span>
                    </div>
                </div>
                <button type="button" class="action-save bg-[#878CFF] text-white flex justify-center rounded-3xl gap-x-2 leading-6 items-center text-sm font-medium w-full py-[5.5px]">
                    Edit My Data
                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.9 13.3009H6.292C6.39728 13.3015 6.50166 13.2814 6.59912 13.2416C6.6966 13.2018 6.78525 13.1431 6.86 13.069L12.396 7.5266L14.668 5.30325C14.743 5.2289 14.8025 5.14044 14.8431 5.04298C14.8837 4.94552 14.9046 4.84099 14.9046 4.73541C14.9046 4.62983 14.8837 4.5253 14.8431 4.42784C14.8025 4.33038 14.743 4.24192 14.668 4.16758L11.276 0.73657C11.2016 0.661609 11.1131 0.602111 11.0157 0.561508C10.9182 0.520905 10.8136 0.5 10.708 0.5C10.6024 0.5 10.4978 0.520905 10.4003 0.561508C10.3029 0.602111 10.2144 0.661609 10.14 0.73657L7.884 2.99991L2.332 8.54231C2.25785 8.61704 2.19919 8.70566 2.15938 8.80311C2.11957 8.90055 2.09939 9.00489 2.1 9.11014V12.5012C2.1 12.7133 2.18429 12.9167 2.33431 13.0667C2.48434 13.2167 2.68783 13.3009 2.9 13.3009ZM10.708 2.43208L12.972 4.69542L11.836 5.83109L9.572 3.56775L10.708 2.43208ZM3.7 9.43805L8.444 4.69542L10.708 6.95877L5.964 11.7014H3.7V9.43805ZM15.7 14.9005H1.3C1.08783 14.9005 0.884344 14.9847 0.734315 15.1347C0.584285 15.2847 0.5 15.4881 0.5 15.7002C0.5 15.9123 0.584285 16.1158 0.734315 16.2658C0.884344 16.4157 1.08783 16.5 1.3 16.5H15.7C15.9122 16.5 16.1157 16.4157 16.2657 16.2658C16.4157 16.1158 16.5 15.9123 16.5 15.7002C16.5 15.4881 16.4157 15.2847 16.2657 15.1347C16.1157 14.9847 15.9122 14.9005 15.7 14.9005Z" fill="#FCFCFD"/>
                    </svg>
                </button>
                @csrf
            </form>
        </div>
        <div class="col-right lg:w-[69%]">
            <h1 class="max-md:hidden text-[48px] leading-[70px] pb-8 border-b border-[#E7ECF3] font-bold mb-12">My Profile</h1>
            <div class="px-5 py-6 mb-8 bg-white shadow-md lg:mb-12 profile-complete lg:px-10 lg:py-5 rounded-2xl">
                <div class="flex flex-wrap items-center mb-3 text-xl font-medium lg:text-2xl profile-progressbar gap-x-6">
                    <p class="max-lg:w-full max-lg:mb-5">Complete your Profile</p>
                    <div class="range w-[78.3%] lg:w-[46.25%] h-[11px] bg-[#316BFF] bg-opacity-20 rounded-3xl relative">
                        <span class="absolute block h-full rounded-3xl left-0 top-0 w-[] bg-[#316BFF]"
                            style="width: {{round($rangeCompleted*100)}}%"
                        ></span>
                    </div>
                    <span class="block max-lg:flex-1 max-lg:text-right">{{round($rangeCompleted*100)}}%</span>
                </div>
                <p class="mb-4 max-lg:text-sm">Get the best out of  TripGuide by adding the remaining details!</p>
                <div class="flex flex-wrap profile-verify max-lg:justify-center lex max-lg:text-xs gap-x-[10px] gap-y-[14px] lg:gap-x-7 lg:mb-4">
                    <div class="flex items-center justify-center px-2 py-[6px] lg:px-4 gap-x-2 rounded-3xl bg-[#E7ECF3] w-max verify-email">
                        <img src="{{asset('images/icon-checked-circle.svg')}}" alt=""> Verified Email ID
                    </div>
                    <div class="flex items-center justify-center px-2 py-[6px] lg:px-4 gap-x-2 rounded-3xl bg-[#E7ECF3] w-max verify-number">
                        <img src="{{asset('images/icon-checked-circle.svg')}}" alt=""> Verified mobile Number
                    </div>
                    <div class="flex items-center justify-center px-2 py-[6px] lg:px-4 gap-x-2 rounded-3xl bg-[#E7ECF3] w-max complete-info">
                        <img src="{{asset('images/icon-plus-circle.svg')}}" alt=""> Complete Basic Info
                    </div>
                </div>
            </div>
            <form action="{{route('user.account.update', $user->id)}}" method="POST" class="form-account-update">
                <div class="flex items-center justify-between mb-6 form-profile-title">
                    <strong class="text-xl font-bold lg:text-2xl">Hi, I'm {{$user->name}}</strong>
                    <button type="button" class="flex items-center text-sm font-medium action-save gap-x-2 py-[6px] border border-[#B1B5C3] rounded-[30px] px-6 lg:px-4 border-solid transition-all">
                        <svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.34788 3.4453L8.93459 2.8586L7.6414 1.56543L7.05469 2.15213L8.34788 3.4453ZM7.60716 4.18585L6.31397 2.89268L1.47635 7.73022L1.17871 9.32103L2.76954 9.02339L7.60716 4.18585ZM9.70627 2.14944C10.0979 2.54108 10.0979 3.17606 9.70627 3.56769L3.39565 9.87821C3.321 9.95287 3.22551 10.0032 3.12173 10.0226L0.620082 10.4907C0.258333 10.5584 -0.0585009 10.2415 0.00918114 9.87978L0.477232 7.37817C0.496649 7.27439 0.546989 7.1789 0.621646 7.10425L6.93226 0.79373C7.3239 0.40209 7.95889 0.40209 8.35053 0.79373L9.70627 2.14944ZM9.47887 10.5H5.25792C4.56311 10.5 4.56311 9.44738 5.25792 9.44738H9.47887C10.1737 9.44738 10.1737 10.5 9.47887 10.5Z" fill="#3B3E44"/>
                        </svg>
                        <span class="lg:hidden">Edit</span>
                        <span class="max-lg:hidden">Edit your profile</span>
                    </button>
                </div>
                <div class="lg:flex lg:gap-x-9">
                    <div class="form-group lg:w-1/2">
                        <label for="" class="text-[16px] font-bold text-[#84878B]">Live in</label>
                        <div class="pl-[10px] !bg-transparent border border-[#DEDFE1] input-wrap">
                            <img src="{{asset('images/icon-profile-home.svg')}}" alt="">
                            <input type="text" name="province" value="{{$user->province}}">
                        </div>
                    </div>
                    <div class="form-group lg:w-1/2">
                        <label for="" class="text-[16px] font-bold text-[#84878B]">Street address</label>
                        <div class="pl-[10px] !bg-transparent border border-[#DEDFE1] input-wrap">
                            <img src="{{asset('images/icon-profile-home.svg')}}" alt="">
                            <input type="text" name="address" value="{{$user->address}}">
                        </div>
                    </div>
                </div>
                <div class="lg:flex lg:gap-x-9">
                    <div class="form-group lg:w-1/2">
                        <label for="" class="text-[16px] font-bold text-[#84878B]">Email address</label>
                        <div class="pl-[10px] !bg-transparent border border-[#DEDFE1] input-wrap">
                            <img src="{{asset('images/icon-profile-email.svg')}}" alt="">
                            <input type="text" name="email" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group lg:w-1/2">
                        <label for="" class="text-[16px] font-bold text-[#84878B]">Phone number</label>
                        <div class="pl-[10px] !bg-transparent border border-[#DEDFE1] input-wrap">
                            <img src="{{asset('images/icon-profile-home.svg')}}" alt="">
                            <input type="number" name="phone" value="{{$user->phone}}">
                        </div>
                    </div>
                </div>
                <div class="lg:flex lg:gap-x-9">
                    <div class="form-group lg:w-1/2">
                        <label for="" class="text-[16px] font-bold text-[#84878B]">Date Of Birth</label>
                        <div class="pl-[10px] !bg-transparent border border-[#DEDFE1] input-wrap">
                            <img src="{{asset('images/icon-profile-cake.svg')}}" alt="">
                            <input type="date" name="birthday" value="{{$user->birthday}}">
                        </div>
                    </div>
                    <div class="form-group lg:w-1/2">
                        <label for="" class="text-[16px] font-bold text-[#84878B]">Gender</label>
                        <div class="flex gap-x-[10px] border border-[#DEDFE1] border-solid rounded-[6px] px-[10px]">
                            <img src="{{asset('images/icon-profile-sex.svg')}}" alt="">
                            <select name="sex" class="block w-full !bg-transparent py-[10px] lg:py-[13.5px]">
                                <option value="0" ></option>
                                <option value="1" {{$user->sex == 1 ? "selected" : ""}}>Male</option>
                                <option value="2" {{$user->sex == 2 ? "selected" : ""}}>Female</option>
                                <option value="3" {{$user->sex == 3 ? "selected" : ""}}>Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
@endsection
