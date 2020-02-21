@extends('layout')

@section('title')
    <title>Test</title>
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="/tasks.css">

@endsection


@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="/clients">Clients</a>
                    </li>
                    <li class="nav-item sub-nav-item subNavActive">
                        <a class="nav-link sub-nav-link" href="/tasks">Tasks</a>
                    </li>
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="#">Expense Categories</a>
                    </li>
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="#">Roles</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

@endsection

@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">
            <div class="col-8">
<h1>{{ session('status') }}</h1>

                <form id="addTask" method="POST" action="/test/123">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label form-control-sm">Task Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                            <small class="red">{{$errors->first('name')}}</small>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Task</button>
                            {{--                            <a class="btn btn-secondary" href="#">Cancel</a>--}}
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
@endsection
