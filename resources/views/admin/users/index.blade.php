@extends('layout')

@section('content')
<div id="contentSection" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">Users
                    <a class="btn btn-success mx-2 btn-sm" href="/admin/users/create">+ Add User</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{implode(',',$user->roles()->get()->pluck('name')->toArray())}}</td>
                            <td>
                                @can('edit-users')
                                <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-sm btn-primary float-left">Edit</a>
                                @endcan
                                @can('delete-users')
                                <form method="POST" action="{{ route('admin.users.destroy',$user->id) }}" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-warning ml-2">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
