@extends('admin.dashboard')

@section('admin.content.more')
    <div class="row">
        <div class="col-md-12">
            <table class="table" border="1">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->status}}</td>
                                <td>
                                    <a class="btn btn-secondary" href="/admin/users/edit/{{$user->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow({{$user->id}}, '/admin/users/delete')">
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
