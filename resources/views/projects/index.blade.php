@extends('layout')
@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-success m-2" href="/projects/new">+ New Project</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

@endsection

@section('content')
    <div class="container" id="contentSection">
        @foreach($clients as $client)
            @php
            if (count($client ->projects)==0) {continue;}
            @endphp
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th style="width:20%;" scope="col">{{$client->name}}</th>
              <th style="width:20%;" scope="col">Budget</th>
              <th style="width:20%;" scope="col">Remaining</th>
              <th style="width:20%;" scope="col">Costs</th>
              <th style="width:20%;" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($client->projects as $project)
            <tr>
              <td>{{$project->name}}</td>
              <td>--</td>
              <td>--</td>
              <td>--</td>
              <td>--</td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <br>
        <br>
        <br>
        @endforeach
    </div>
@endsection
