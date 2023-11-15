@extends('admin.dashboard')

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.store.attribute.create") }}" class="btn btn-primary">Add New Attribute</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Attribute Code</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($attributes) > 0)
                        @foreach ($attributes as $attribute)
                            <tr>
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->label }}</td>
                                <td>{{ $attribute->attribute_code }}</td>
                                <td>{{ $attribute->active }}</td>
                                <td>{{ $attribute->position }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('admin.store.attribute.edit', $attribute->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$attribute->id}}, '/admin/store/attributes/delete')">
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
