@extends('admin.dashboard')

@php
use App\Http\Services\CountryService;

$CountryService = new CountryService;
@endphp

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="#" id="get-city-api" class="btn btn-primary">Get City</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>City Name</th>
                        <th>ISO2</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if (count($countries) > 0)
                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->name }}</td>
                                <td>
                                    {{ $CountryService->getCapitalName($country->id)}}
                                </td>
                                <td>
                                    {{ $CountryService->getLanguage($country->id)}}
                                </td>
                                <td>
                                    <img src="{{ $CountryService->getFlag($country->id)}}" style="width: 60px" alt="">
                                </td>
                                <td>
                                    <a target="_blank" href="{{ $CountryService->getMap($country->id)}}">{{ $CountryService->getMap($country->id)}}</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif --}}
                </tbody>
            </table>

            {{-- {{$countries->links("pagination::bootstrap-4")}} --}}
        </div>
    </div>
@endsection
