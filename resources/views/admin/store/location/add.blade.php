@extends('admin.dashboard')

@section('admin.content.more')
    <form action="{{ route('admin.locations.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2 form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable" name="active" checked>
                    <label class="form-check-label" for="enable">Enable</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2 form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable" name="is_best">
                    <label class="form-check-label" for="enable">Best Place</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Location Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Post Code</label>
                    <input type="number" class="form-control" name="post_code">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="upload">Image</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="upload">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
            <div id="feature-image-show" class="mt-2"></div>
        </div>
        <button type="submit" class="mt-2 btn btn-primary">Save</button>
        @csrf
    </form>
@endsection

