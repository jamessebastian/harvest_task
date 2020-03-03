@extends('layout')

@section('title')
<title>Manage</title>
@endsection

@section('sub-navbar')
    <nav id="subNavbar" class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item sub-nav-item subNavActive">
                        <a class="nav-link sub-nav-link" href="/clients">Clients</a>
                    </li>
                    <li class="nav-item sub-nav-item">
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

@section('tail')
    <script>
        $('.alert').hide();
        $("body").on("click", ".delete", function(e) {
            uuid = $(e.currentTarget).data("uuid");
            hideElement = $(e.currentTarget).parent().parent().parent();
            $("#exampleModalLabel").text("Are you sure you want to delete " + $(e.currentTarget).data("client-name"));

            //console.log( e.currentTarget.getAttribute("data-id").toString());
            //console.log(e.currentTarget.getAttribute("data-id")==$(e.currentTarget).data("id"));
        });



        $(document).ready(function() {
            $("#yes").on("click", function(){

                $.ajax({
                    type 		: 'POST',
                    url 		: '/clients/'+uuid,
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
@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">
            <div class="col-8">
                <h3>Manage clients</h3>
                <a class="btn btn-success btn-sm" href="clients/create" role="button"><strong>+ New Client</strong></a>
                <div class="alert mt-4 alert-danger" role="alert"></div>
                <table class="table table-hover mt-4">
                    <tbody>

                    @foreach ($clients as $client)
                    <tr>
{{--                        <th scope="row"><a class="btn btn-sm btn-secondary" href="#" role="button">Edit</a></th>--}}
                        <td>{{$client->name}}</td>
                        <td>
                            <button class="mx-2 btn btn-sm btn-info" onclick="window.location.href = '/clients/{{$client->uuid}}/edit';">Edit</button>
                            <form onsubmit="return false;" style="display:inline;" method="POST" action="/clients/{{$client->uuid}}">
                                @csrf
                                @method('DELETE')
                                <button data-toggle="modal" data-client-name="{{$client->name}}" data-uuid="{{$client->uuid}}" data-target="#exampleModal" class="btn btn-sm btn-danger delete">Delete</button>
                            </form>
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



            </div>
        </div>
    </div>
@endsection
