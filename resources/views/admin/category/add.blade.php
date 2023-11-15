@extends('admin.dashboard')

@section('admin.content.more')
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-2 form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="enable" name="active" checked>
            <label class="form-check-label" for="enable">Enable</label>
        </div>
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" class="form-control" placeholder="Enter name" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="">Parent Category</label>
            <select class="form-select" aria-label="Default select example" name="parent_id">
                <option value="0">Default Category</option>
                @if (count($categories) > 0)
                    {!! \App\Helpers\Helper::categoriesSelectTree($categories) !!}
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="">Category Image Icon</label>
            <input type="text" class="form-control" placeholder="Enter html icon" name="image">
        </div>
        <button type="submit" class="mt-2 btn btn-primary">Save</button>
        @csrf
    </form>
@endsection

