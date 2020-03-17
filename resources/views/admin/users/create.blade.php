@extends('layout')

@section('content')
    <div id="contentSection" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">Add User</div>

                    <div class="card-body">
                        <form action=" {{ route('admin.users.store') }} " method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email <span class="red">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name <span class="red">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">Roles <span class="red">*</span></label>
                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            <input type="checkbox" value="{{$role->id}}" name="roles[]">
                                            <label>{{$role->name}}</label>

                                        </div>
                                    @endforeach
                                    @error('roles')
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add User and Send Invitation</button>
                             @if(session('message'))
                                <p class="text-success my-3"><strong>{{ session('message') }}</strong></p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
