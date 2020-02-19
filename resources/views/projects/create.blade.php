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
                            <select class="form-control" name="client" id="client">
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="projectName" class="col-sm-2 col-form-label form-control-sm">Project Name</label>
                        <div class="col-sm-5">
                            <input type="text" name="projectName" class="form-control" id="projectName">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="team" class="col-sm-2 col-form-label form-control-sm">Team</label>
                        <div class="col-sm-6">
                            <select id="team" class="js-example-basic-multiple" name="team[]" multiple="multiple">
                                @foreach($persons as $person)
                                    <option value="{{$person->id}}">{{$person->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tasks" class="col-sm-2 col-form-label form-control-sm">Tasks</label>
                        <div class="col-sm-5">
                            <select id="tasks" class="form-control js-example-tags"  name="tasks[]" multiple="multiple">
                                @foreach($tasks as $task)
                                    <option value="{{$task->id}}">{{$task->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Project</button>
                            <a class="btn btn-secondary" href="/clients">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
