@extends('admin.dashboard')

@php
use App\Http\Services\TourService;

$tourService = new TourService;
@endphp

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.hotel.tours.create") }}" class="btn btn-primary">Add New Tour</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Tour Name</th>
                        <th>Image</th>
                        <th>Country</th>
                        <th>Number Popular</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tours) > 0)
                        @foreach ($tours as $tour)
                            <tr>
                                <td>{{ $tour->id }}</td>
                                <td>{{ $tour->tour_name }}</td>
                                <td>
                                    <a href="{{ $tour->image }}">
                                        <img src="{{ $tour->image }}" style="width: 150px; height: 100px" alt="">
                                    </a>
                                </td>
                                <td>{{ $tourService->getCountry($tour->country_id)}}</td>
                                <td>{{ $tour->number_popular }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.hotel.tours.edit', $tour->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$tour->id}}, '/admin/hotel/tours/delete')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
