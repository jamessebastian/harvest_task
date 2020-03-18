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
                    <div id="tableWrapper">
                        @include('admin.users.ajaxIndex')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
