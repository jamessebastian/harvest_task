@extends('layout')

@section('title')
<title>Manage</title>
@endsection

@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item sub-nav-item subNavActive">
                        <a class="nav-link sub-nav-link" href="/clients">Clients</a>
                    </li>
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="/tasks">Tasks</a>
                    </li>
{{--                    <li class="nav-item sub-nav-item">--}}
{{--                        <a class="nav-link sub-nav-link" href="#">Expense Categories</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item sub-nav-item">--}}
{{--                        <a class="nav-link sub-nav-link" href="#">Roles</a>--}}
{{--                    </li>--}}
                </ul>

            </div>
        </div>
    </nav>

@endsection

@section('content')
    <div class="container" id="contentSection">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <h3><strong>New client</strong></h3>
                <p>Once you’ve added a client, you can add projects and contacts.</p>
                <hr>
                <form method="POST" action="/clients">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                      Please enter the correct values
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label form-control-sm">Client Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="clientName" value="{{old('name')}}">
                            @if($errors->has('name'))
                            <small class="red">{{$errors->first('name')}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label form-control-sm">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address" id="address" rows="3">{{old('address')}}</textarea>
                            @error('address')
                            <small class="red">{{$errors->first('address')}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="preferredCurrency" class="col-sm-2 col-form-label form-control-sm">Preferred Currency</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="currency" id="preferredCurrency">
                                <option {{old('currency')=='INR'? 'selected':''}} value="INR">Indian Rupee - INR</option>
                                <option {{old('currency')=='EUR'? 'selected':''}} value="EUR">Euro - EUR</option>
                                <option {{old('currency')=='USD'? 'selected':''}} value="USD">American Dollar - USD</option>
                                <option {{old('currency')=='AUD'? 'selected':''}} value="AUD">Australian Dollar - AUD</option>
                                <option {{old('currency')=='CAD'? 'selected':''}} value="CAD">Canadian Dollar - CAD</option>
                                <option {{old('currency')=='JPY'? 'selected':''}} value="JPY">Japanese Yen - JPY</option>
                            </select>
                            <small class="red">{{$errors->first('currency')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Client</button>
                            <a class="btn btn-secondary" href="/clients">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection
