@extends('layout')

@section('title')
<title>TimesSheet</title>
@endsection


@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item sub-nav-item">
                        <a class="nav-link sub-nav-link" href="/time">Timesheet</a>
                    </li>
                    <li class="nav-item sub-nav-item subNavActive">
                        <a class="nav-link sub-nav-link" href="/approve">Pending Approval</a>
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
            <div class="col-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">user</th>
                        <th scope="col">start_date</th>
                        <th scope="col">end_date</th>
                        <th scope="col">status</th>
                        <th scope="col">total_expense</th>
                        <th scope="col">total_hours</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($timesheets as $timesheet)
                        <tr>
                            <th scope="row">{{$timesheet->id}}</th>
                            <td>{{$timesheet->user->name}}</td>
                            <td>{{$timesheet->start_date}}</td>
                            <td>{{$timesheet->end_date}}</td>
                            <td>{{$timesheet->status?'':'Unsubmitted'}}</td>
                            <td>{{$timesheet->total_expense}}</td>
                            <td>{{$timesheet->total_hours}}</td>
                            <td><a href="#" class="btn btn-sm btn-success">Approve</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
