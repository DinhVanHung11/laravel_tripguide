@extends('admin.dashboard')

@section('admin.content.more')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.store.configuration.store') }}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Store Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{$config->name ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="upload">Logo</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="upload">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    <div id="feature-image-show" class="mt-2">
                        @if (isset($config->image))
                            <div class="image-show-item d-inline-block" id="{{$id}}">
                                <a href="{{$config->image}}" target="_blank">
                                    <img src="{{$config->image}}" alt="">
                                </a>
                                <a href="javascript:void(0)" class="text-secondary delete-image" onclick="removeImageUpload({{$id}})">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <input type="hidden" name="image" value="{{$config->image}}">
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Save</button>
                @csrf
            </form>
        </div>
    </div>
@endsection
