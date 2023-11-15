@extends('admin.dashboard')

@php
use App\Helpers\Helper;

$helper = new Helper;
@endphp

@section('admin.content.more')
    <div class="row">
        <div class="mb-5 col-md-2">
            <a href="{{ route("admin.category.create") }}" class="btn btn-primary">Add New Category</a>
        </div>
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent ID</th>
                        <th>Immage Icon</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories) > 0)
                        {!! \App\Helpers\Helper::categoriesTableTree($categories) !!}
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
