@extends('admin.dashboard')

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.hotel.tags.add") }}" class="btn btn-primary">Add New Tag</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color Text</th>
                        <th>Position</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tags) > 0)
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <div class="w-10 h-10 tag-color" style="background: #{{ $tag->color }}"></div>
                                </td>
                                <td>{{ $tag->position }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.hotel.tags.edit', $tag->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$tag->id}}, '/admin/hotel/tags/delete')">
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
