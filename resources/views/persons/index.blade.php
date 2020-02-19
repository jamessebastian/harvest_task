@extends('layout')

@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-success m-2" href="/person/new">+ Add Person</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

@endsection

@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">
            <div class="col-11">
                @if(count($persons))
                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">Employee</th>
                        <th scope="col">Total Hours</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Billable Hours</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($persons as $person)
                        <tr>
                           <td>
                               {{$person->name}}
                           </td>
                            <td>--</td>
                            <td>{{$person->capacity}}</td>
                            <td>--</td>
                            <td>
                                <form style="display:inline" method="POST" action="/person/{{$person->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">DELETE</button>
                                </form>
{{--                                <button onclick="window.location.href = '/person/{{$person->id}}/edit';">EDIT</button>--}}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                @else
                    <img style="display: block;" class="w-50" src="/no_results_found.png">
                @endif
            </div>
        </div>
    </div>
@endsection
