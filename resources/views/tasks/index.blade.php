@extends('layout')

@section('title')
<title>Manage</title>
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="/tasks.css">

@endsection

@section('tail')
    <script src="/ajax.js"></script>
    <script src="/taskValidation.js"></script>
    <script src="/tasksIndex.js"></script>
    <script>

        let token = "<?php echo csrf_token(); ?>";
        let currentPageCount = 5;
        let nameSortOrder = 'asc';
        let rateSortOrder = 'asc';

    </script>



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
        <div class="row justify-content-center">
            <div class="col-8">
                <form onsubmit="return validate();" id="addTask" method="POST" action="/tasks">
                    @csrf
                    <h3><strong>Add New Task</strong></h3>
                    <hr>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label form-control-sm">Task Name <span class="red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                            <small id="nameErr" class="red">{{$errors->first('name')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hourly_rate" class="col-sm-2 col-form-label form-control-sm">Hourly Rate <span class="red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="hourly_rate" class="form-control" value="{{old('hourly_rate')}}" id="hourlyRate">
                            <small id="hourlyRateErr" class="red">{{$errors->first('hourly_rate')}}</small>
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
                @if(count($tasks))
                    <h3 class="mt-5"><strong>Tasks</strong></h3>

                    <form id="searchForm" onsubmit="return searchSubmit('<?php echo csrf_token(); ?>');">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchItem" name="search" value="{{ request()->search }}">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn  btn-primary my-2 my-sm-0" type="submit">Search Clients</button>
                            </div>
                        </div>
                    </form>


                    <div class="alert alert-danger" role="alert"></div>
                    <div id="tableWrapper">
                        @include('tasks.ajaxIndex')
                    </div>









                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="button" id="yes" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>



                @endif
            </div>
        </div>
    </div>
@endsection
