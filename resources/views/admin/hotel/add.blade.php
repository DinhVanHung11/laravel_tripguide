@extends('admin.dashboard')

@section('admin.head.more')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{asset('lib/select2/select2.min.css')}}">
    <script src="/lib/ckeditor/ckeditor.js"></script>
@endsection


@php
use \App\Models\Attribute;

$attributeModel = new Attribute;
@endphp

@section('admin.content.more')
    <form action="{{ route('admin.hotel.store') }}" id="form-add" method="POST" enctype="multipart/form-data">
        <div class="mb-2 form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="enable" name="active" checked>
            <label class="form-check-label" for="enable">Enable</label>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-select" aria-label="Default select example" name="location_id">
                        <option value="0">Choose location</option>
                        @if (count($countries) > 0)
                            @foreach ( $countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Position</label>
                    <input type="number" class="form-control" placeholder="Enter position" name="position">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tags</label>
                    <select class="form-control tag_select_choose" name="tags[]" multiple="multiple">
                        @if (count($tags) > 0)
                            @foreach ( $tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Extra Features</label>
                    <select class="form-control extrafeature_select_choose" name="extra_features[]" multiple="multiple">
                        @if (count($extraFeatures) > 0)
                            @foreach ( $extraFeatures as $extraFeature)
                                <option value="{{ $extraFeature->id }}">{{ $extraFeature->label }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" name="description" rows="5" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control" placeholder="Enter price" name="price">
                    <a class="modal-advance-price" href="#modal-advance-price" rel="modal:open">
                        Advance Price
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Room</label>
                    <input type="number" class="form-control">
                    <a class="modal-advance-room" href="#modal-advance-room" rel="modal:open">
                        Add Advance Room
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Rating</label>
                    <input type="number" class="form-control" placeholder="Enter rating" name="rating" max="5" min="0">
                </div>
            </div>
            @if (isset($attributes) && count($attributes) > 0)
                @foreach ($attributes as $attribute )
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ $attribute->label }}</label>
                            @if ($attribute->type == \App\Models\Attribute::ONESELECT)
                                <select class="form-select" aria-label="Default select example" name="attribute_option[]">
                                    @if (count($attribute->values) > 0)
                                        @foreach ( $attribute->values as $option)
                                            <option value="{{ $option->id }}">{{ $option->label }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @else
                                <select class="form-control attributes_select_choose" name="attribute_option[]" multiple="multiple">
                                    @if (count($attribute->values) > 0)
                                        @foreach ( $attribute->values as $option)
                                            <option value="{{ $option->id }}">{{ $option->label }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
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
        <div class="form-group">
            <label for="upload_gallery">Gallery Images</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="upload_gallery">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
            <div id="gallery-image-show" class="gap-4 mt-2 d-flex">
            </div>
        </div>

        <button type="button" data-url="{{ route('admin.hotel.store') }}" class="mt-2 !bg-[#3B71FE] btn btn-primary" id="action-save">Save</button>
        @csrf
    </form>
    @include('admin.hotel.advance_price')
    @include('admin.hotel.room')
@endsection

@section('admin.script.more')
    <!-- bs-custom-file-input -->
    <script src="/template/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{asset('lib/select2/select2.min.js')}}"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();
        });

        $(".attributes_select_choose").select2({
            tags: true,
            tokenSeparators: [',']
        });

        $(".tag_select_choose").select2({
            tags: true,
            tokenSeparators: [',']
        });

        $(".extrafeature_select_choose").select2({
            tags: true,
            tokenSeparators: [',']
        });
    </script>
@endsection

