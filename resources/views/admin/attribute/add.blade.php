@extends('admin.dashboard')

@section('admin.head.more')
@endsection

@section('admin.content.more')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="attribute-properties-label"
                data-bs-toggle="tab" data-bs-target="#attribute-properties-content"
                type="button" role="tab"
                aria-controls="attribute-properties" aria-selected="true"
            >
                    Properties
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="attribute-manage-label"
                data-bs-toggle="tab" data-bs-target="#attribute-manage-content"
                type="button" role="tab"
                aria-controls="attribute-manage-content" aria-selected="false"
            >
                Manage Options
            </button>
        </li>
    </ul>
    <form action="{{ route('admin.store.attribute.store') }}" method="POST" id="admin-edit-form">
        <div class="mt-3 tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="attribute-properties-content"
                role="tabpanel" aria-labelledby="attribute-properties-label"
            >
                @include('admin.attribute.properties')
            </div>
            <div class="tab-pane fade" id="attribute-manage-content"
                role="tabpanel" aria-labelledby="attribute-manage-label"
            >
                @include('admin.attribute.options')
            </div>
            <button type="submit" class="mt-5 btn btn-primary" id="save">Save Attribute</button>
            @csrf
        </div>
    </form>
@endsection

@section('admin.script.more')
    <script>
    </script>
@endsection



