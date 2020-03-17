@extends('layout')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

@endsection

@section('tail')
    <script src="/multi-input-glitch/multi-input.js"></script>

    <script src="/projectsCreate.js" ></script>
@endsection

@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">
            <div class="col-11">
                <h4><strong>New Project</strong></h4>
                <hr class="specialHr">
                <form method="POST" action="/projects">
                    @csrf






                    <div class="form-group row">
                        <label for="preferredCurrency" class="col-sm-2 col-form-label form-control-sm">Client</label>
                        <div class="col-sm-5">
                            <select value="{{ old('client') }}" class="form-control" name="client" id="client">
                                <option>--Select Any--</option>
                                @foreach($clients as $client)
                                <option {{old('client')==$client->id? 'selected':''}} value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                            <small id="clientErr" class="red">{{ $errors->first('client') }}</small>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label form-control-sm">Project Name</label>
                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="projectName"  value="{{old('name')}}">
                            <small id="nameErr" class="red">{{ $errors->first('name') }}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="team" class="col-sm-2 col-form-label form-control-sm">Team</label>
                        <div class="col-sm-6">
                            <select id="team" class="js-example-basic-multiple" name="team[]" multiple="multiple">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <small style="display: block" id="teamErr" class="red">{{ $errors->first('team') }}</small>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="tasks" class="col-sm-2 col-form-label form-control-sm">Tasks</label>
                        <div class="col-sm-6">
                            <select id="tasks" class="js-example-basic-multiple" name="tasks[]" multiple="multiple">
                                @foreach($tasks as $task)
                                    <option value="{{$task->id}}">{{$task->name}}</option>
                                @endforeach
                            </select>
                            <small style="display: block" id="tasksErr" class="red">{{ $errors->first('tasks') }}</small>

                        </div>
                    </div>

















                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Project</button>
                            <a class="btn btn-secondary" href="/projects">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
