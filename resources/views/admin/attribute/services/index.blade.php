@extends('admin.dashboard')

@php
use App\Http\Services\FeatureService;

$exServiceHelper = new FeatureService;
@endphp

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.hotel.extrafeatures.add") }}" class="btn btn-primary">Add New Services</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Price</th>
                        <th>Position</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($exServices) > 0)
                        @foreach ($exServices as $exService)
                            <tr>
                                <td>{{ $exService->id }}</td>
                                <td>{{ $exService->label }}</td>
                                <td>{{ $exService->price }}</td>
                                <td>{{ $exService->position }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.hotel.extrafeatures.edit', $exService->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$exService->id}}, '/admin/hotel/extra-features/delete')">
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
