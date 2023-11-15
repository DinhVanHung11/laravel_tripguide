@extends('admin.dashboard')

@section('admin.content.more')
    <form action="{{ route('admin.hotel.tags.store') }}" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enable" checked>
                    <label class="form-check-label" for="enable">Enable</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Position</label>
                    <input type="number" class="form-control" placeholder="Enter name" name="position" min="0">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
            <label for="">Color</label>
            <input type="text" class="form-control" placeholder="Enter name" name="color">
        </div>
        <button type="submit" class="mt-2 btn !bg-[#3B71FE] btn-primary">Save</button>
        @csrf
    </form>
@endsection

