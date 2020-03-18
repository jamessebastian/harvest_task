@extends('layout')

@section('content')
<div id="contentSection" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User : <strong>{{$user->name}}</strong></div>

                <div class="card-body">
                    <form action=" {{ route('admin.users.update',$user->uuid) }} " method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        @if($user != Auth::user())
                        <div class="form-group row">
                            <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                            <div class="col-md-6">
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="checkbox" value="{{$role->id}}" name="roles[]" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                        <label>{{$role->name}}</label>

                                    </div>
                                @endforeach
                                @error('roles')
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
