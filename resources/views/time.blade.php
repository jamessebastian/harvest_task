@extends('layout')

@section('title')
<title>TimesSheet</title>
@endsection

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/time.css">
@endsection

@section('tail')
<script src="/time.js"></script>

@endsection

@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item sub-nav-item subNavActive">
                        <a class="nav-link sub-nav-link" href="\time">Timesheet</a>
                    </li>
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="\approve">Pending Approval</a>
                    </li>
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="#">Unsubmitted</a>
                    </li>
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="#">Archive</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

@endsection

@section('content')
    <div class="container-fluid" id="contentSection">
        <div class="row justify-content-center">
            @if(count($projects)>0 and count($tasks)>0)
            <div class="col-8">

                <h2 style="display:inline;"><strong>{{substr($date->toRfc1123String(),0,16)}}</strong>
                 @if(Carbon\Carbon::now()->toDateString()==$date->toDateString())
                    (Today)
                 @endif
                </h2>
                @if(Carbon\Carbon::now()->toDateString()!=$date->toDateString())
                    <a class="ml-3" href="/time/{{Carbon\Carbon::now()->format('Y/m/d')}}">Return to Today</a>
                @endif

                <div class="input-group mt-2 mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Date</span>
                    </div>
                    <input value="{{$date->toDateString()}}" type="date" id="date" class="form-control mr-4 col-3">

                    <div class="input-group-prepend">
{{--                        <button onclick="window.location.href = '/time/{{$date->subDays(1)->format('Y/m/d')}}'" class="input-group-text"><</button>--}}
                        <a href="/time/{{$date->addDays(-1)->format('Y/m/d')}}" class="input-group-text">< </a>
                    </div>
                    <div class="input-group-append">
                        <a href="/time/{{$date->addDays(2)->format('Y/m/d')}}" class="input-group-text">> </a>
{{--                        <button onclick="window.location.href = '/time/{{$date->addDays(1)->format('Y/m/d')}}'" class="input-group-text">{{$date->addDays(1)->format('Y/m/d')}}<</button>--}}
                    </div>
                </div>
                @php
                $date->addDays(-1);


                @endphp


                <div class="container-fluid mb-0 border">
                    <div class="row justify-content-around" id="days">
                        <div onclick="window.location.href = '/time/{{$weekDays[0]}}'" {{($date->format('Y/m/d')==$weekDays[0])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Mon</span></div>
                        <div onclick="window.location.href = '/time/{{$weekDays[1]}}'" {{($date->format('Y/m/d')==$weekDays[1])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Tue</span></div>
                        <div onclick="window.location.href = '/time/{{$weekDays[2]}}'" {{($date->format('Y/m/d')==$weekDays[2])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Wed</span></div>
                        <div onclick="window.location.href = '/time/{{$weekDays[3]}}'" {{($date->format('Y/m/d')==$weekDays[3])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Thu</span></div>
                        <div onclick="window.location.href = '/time/{{$weekDays[4]}}'" {{($date->format('Y/m/d')==$weekDays[4])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Fri</span></div>
                        <div onclick="window.location.href = '/time/{{$weekDays[5]}}'" {{($date->format('Y/m/d')==$weekDays[5])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Sat</span></div>
                        <div onclick="window.location.href = '/time/{{$weekDays[6]}}'" {{($date->format('Y/m/d')==$weekDays[6])?"id=activeWeek":""}} class="lightGray col border day"><span class="qwe">Sun</span></div>
                    </div>

                </div>
                @if(count($entries))

                <table class="table mt-4">

                    <tbody>
                    <?php $sum=0;  ?>
                    @foreach($entries as $entry)
                    @php
                        $sum+=$entry->time;
                    @endphp
                    <tr>
                        <td>{{$entry->projects->name}} ( {{$entry->projects->clients->name}} )<br>{{$entry->tasks->name}} - {{$entry->notes}}</td>
                        <td><strong> {{$entry->time}} Hr</strong></td>
                        <td>
                            <form method="POST" action="/timeEntry/{{$entry->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td> Total: <strong>{{$sum}} Hr</strong></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

                @endif

                <!-- Button trigger modal -->
                <button type="button" class="btn mb-3 mt-3 btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    + Add Entry
                </button>
                <form action="">
                    @csrf
                    <button type="submit" class="btn mb-3 btn-success">
                        Submit Week for Approval
                    </button>
                </form>


               @if(!count($entries))
                <img style="display: block;" class="w-50" src="/no_results_found.png">
               @endif


                <!-- Modal -->
                <div class="modal bd-example-modal-lg fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><strong>New Time Entry ({{substr($date->toRfc1123String(),0,16)}})</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form id="addTimeEntry" method="POST" action="/time">
                                    @csrf

                                    <input hidden type="date" name="date" value="{{$date->toDateString()}}">

                                    <div class="form-group row">
                                        <label for="projects" class="col-sm-2 col-form-label form-control-sm">Projects</label>
                                        <div class="col-sm-7">
                                            <select id="projects" class="form-control"  name="project">
                                                @foreach($projects as $project)
                                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tasks" class="col-sm-2 col-form-label form-control-sm">Tasks</label>
                                        <div class="col-sm-7">
                                            <select id="tasks" class="form-control"  name="task">
                                                @foreach($tasks as $task)
                                                    <option value="{{$task->id}}">{{$task->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="taskName" class="col-sm-2 col-form-label form-control-sm">Notes</label>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hourlyRate" class="col-sm-2 col-form-label form-control-sm">Time</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="timeInHours" class="form-control" id="timeInHours">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-success">Save Task</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            {{--                            <a class="btn btn-secondary" href="#">Cancel</a>--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <h2>You need to add projects and tasks first</h2>
            @endif
        </div>

    </div>
@endsection
