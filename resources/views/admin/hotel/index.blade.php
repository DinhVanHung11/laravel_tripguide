@extends('admin.dashboard')

@php
use App\Helpers\HotelHelper;
use App\Http\Services\HotelService;

$hotelHelper = new HotelHelper;
$hotelService = new HotelService;
@endphp

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.hotel.create") }}" class="btn btn-primary">Add New Hotel</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Position</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($hotels) > 0)
                        @foreach ($hotels as $hotel)
                            <tr>
                                <td>{{ $hotel->id }}</td>
                                <td>{{ $hotel->name }}</td>
                                <td>
                                    <a href="{{ $hotel->image }}">
                                        <img src="{{ $hotel->image }}" style="width: 150px; height: 100px" alt="">
                                    </a>
                                </td>
                                <td>{{ $hotelService->getCountryName($hotel->location_id)}}</td>
                                <td>${{ $hotel->price }}</td>
                                <td>{{ $hotelHelper->getType($hotel->optionsAttributes) }}</td>
                                <td>{{ $hotel->position }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.hotel.edit', $hotel->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$hotel->id}}, '/admin/catalog/product/delete')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            {{$hotels->links("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection
