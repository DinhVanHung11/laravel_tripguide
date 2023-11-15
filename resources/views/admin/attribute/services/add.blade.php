@extends('admin.dashboard')

@section('admin.content.more')
    <form action="{{ route('admin.hotel.extrafeatures.store') }}" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable" checked>
                    <label class="form-check-label" for="enable">Enable</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable" name="calculated_people">
                    <label class="form-check-label" for="enable">Calculated by number of people</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Label</label>
                    <input type="text" class="form-control" name="label">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control" name="price">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Position</label>
                    <input type="number" class="form-control" name="position" min="0">
                </div>
            </div>
        </div>
        <button type="submit" class="mt-2 btn !bg-[#3B71FE] btn-primary">Save</button>
        @csrf
    </form>
@endsection

