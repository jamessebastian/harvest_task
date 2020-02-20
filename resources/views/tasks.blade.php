@extends('layout')

@section('title')
<title>Manage</title>
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="/tasks.css">

@endsection

@section('tail')
    <script>
        $('.alert').hide();
        $("body").on("click", ".delete", function(e) {
            uuid = $(e.currentTarget).data("uuid");
            hideElement = $(e.currentTarget).parent().parent().parent();
            $("#exampleModalLabel").text("Are you sure you want to delete " + $(e.currentTarget).data("task-name"));

            //console.log( e.currentTarget.getAttribute("data-id").toString());
            //console.log(e.currentTarget.getAttribute("data-id")==$(e.currentTarget).data("id"));
        });



        $(document).ready(function() {
            $("#yes").on("click", function(){

                $.ajax({
                    type 		: 'POST',
                    url 		: '/tasks/'+uuid,
                    data 		: {'id':uuid,
                                    "_token": "<?php echo csrf_token(); ?>",
                                    "_method":"DELETE"},
                    dataType 	: 'json',
                    success 	: function(data) {
                        if (data) {
                            hideElement.hide();
                            $('.alert').show();
                            $('.alert').text(data.msg);


                             setTimeout(()=>{$('.alert').hide();}, 2000);
                        }
                    }
                });

            });
        });


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
                <form id="addTask" method="POST" action="/tasks">
                    @csrf
                    <h3><strong>Add New Task</strong></h3>
                    <hr>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label form-control-sm">Task Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                            <small class="red">{{$errors->first('name')}}</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hourly_rate" class="col-sm-2 col-form-label form-control-sm">Hourly Rate</label>
                        <div class="col-sm-10">
                            <input type="text" name="hourly_rate" class="form-control" value="{{old('hourly_rate')}}" id="hourlyRate">
                            <small class="red">{{$errors->first('hourly_rate')}}</small>
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
                    <div class="alert alert-danger" role="alert"></div>

                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Hourly Rate</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>



                    @foreach ($tasks as $task)
                        <tr>
                            {{--                        <th scope="row"><a class="btn btn-sm btn-secondary" href="#" role="button">Edit</a></th>--}}
{{--                            <td><button class="mx-2" onclick="window.location.href = '/tasks/{{$task->id}}';">Delete</button>{{$task->name}}</td>--}}
                            <td>
                                {{$task->name}}
                            </td>
                            <td>
                                {{$task->hourly_rate}}
                            </td>
                            <td>
                                <form onsubmit="return false;" method="POST" style="display:inline;" action="/tasks/{{$task->uuid}}">
                                    @csrf
                                    @method('DELETE')
                                    <button data-toggle="modal" data-task-name="{{$task->name}}" data-target="#exampleModal" data-uuid="{{$task->uuid}}" class="btn btn-danger btn-sm delete" type="submit">Delete</button>
                                </form>
                                <a class="btn btn-sm btn-info" href="/tasks/{{$task->uuid}}/edit">Edit</a>
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>



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
