@extends('admin.dashboard')

@section('admin.content.more')
    <form action="{{ route('admin.hotel.tours.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2 form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable" name="active" checked>
                    <label class="form-check-label" for="enable">Enable</label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Tour Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="tour_name">
            </div>
            <div class="col-md-6">
                <div class="relative form-group">
                    <label for="">Country</label>
                    <input type="text" class="form-control search-input" placeholder="Enter country" id="input-search-country">
                    <input type="hidden" name="country_id" class="search-value">
                    <div class="absolute bottom-0 left-0 z-30 w-full search-results country-results">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Number Popular</label>
                    <input type="number" class="form-control" placeholder="Enter number popular" name="number_popular">
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
        </div>
        <button type="submit" class="mt-2 btn btn-primary !bg-[#007bff]">Save</button>
        @csrf
    </form>
@endsection

@section('admin.script.more')
    <script src="/template/admin/js/country/country.js"></script>
@endsection

