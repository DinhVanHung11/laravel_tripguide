@extends('admin.dashboard')

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.locations.create") }}" class="btn btn-primary">Add Location</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Post Code</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($locations) > 0)
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $location->id }}</td>
                                <td>{{ $location->name }}</td>
                                <td>
                                    <img src="{{ $location->image }}" style="width: 100px; height:80px; object-fit: cover" alt="">
                                </td>
                                <td>{{ $location->post_code }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.locations.edit', $location->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$location->id}}, '/admin/catalog/product/delete')">
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
