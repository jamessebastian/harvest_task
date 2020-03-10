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


@section('tail')
    <script src="/projectIndex.js"></script>
@endsection

@section('content')
    <div class="container" id="contentSection">
        @foreach($clients as $client)
            @php
            if (count($client->projects)==0) {continue;}
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
              <td>
                  <button class="mx-2 btn btn-sm btn-info" onclick="window.location.href = '/projects/{{$project->uuid}}/edit';">Edit</button>

                  <form id="project-{{$project->uuid}}" onsubmit="return false;" style="display:inline;" method="POST" action="/projects/{{$project->uuid}}">
                      @csrf
                      @method('DELETE')
                      <button data-toggle="modal" data-project-name="{{$project->name}}" data-uuid="{{$project->uuid}}" data-target="#exampleModal" class="btn btn-sm btn-danger delete">Delete</button>
                  </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <br>
        <br>
        <br>
        @endforeach









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
                            <form id="projectDelete" style="display:inline;" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




    </div>
@endsection
