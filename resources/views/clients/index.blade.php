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
    <script src="/ajax.js"></script>
    <script src="/clientIndex.js"></script>
    <script>



        $(document).on('click','#nameSort',function (e) {
            e.preventDefault();
            url = $(this).attr('href');
            params = getUrlParams(url);

            ajax('POST',
                'clients/ajaxIndex',
                {
                    "_token": "<?php echo csrf_token(); ?>",
                    "search":$("#searchItem").val()
                },);

        })


        $(document).ready(function() {



            $("#yes").on("click", function(){

                ajax('POST',
                    '/clients/'+uuid,
                    {'id':uuid,
                    "_token": "<?php echo csrf_token(); ?>",
                    "_method":"DELETE"
                    },
                    (data) => {
                          //  hideElement.hide();
                            $('.alert').show();
                            $('.alert').text(data.msg);
                            setTimeout(()=>{$('.alert').hide();}, 2000);
                        windowLocation = new URL(window.location);
                        ajax('POST',
                            'clients/ajaxIndex',
                            {
                                "_token": "<?php echo csrf_token(); ?>",
                                "search":windowLocation.searchParams.get('search'),
                                "sort":windowLocation.searchParams.get('sort'),
                                "order":windowLocation.searchParams.get('order'),
                                "page":windowLocation.searchParams.get('page'),
                            },
                            (data) => {
                                $("#tableWrapper").html(data.html);
                            }
                        );
                    }
                );



            });



        });
    </script>

@endsection
@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">
            <div class="col-8">
                <h3>Manage clients</h3>
                <a class="btn btn-success btn-sm mb-3" href="clients/create" role="button"><strong>+ New Client</strong></a>


{{--                @foreach($data as $item)--}}
{{--                    <ul>--}}
{{--                        <li>{{ $item->name }}</li>--}}
{{--                    </ul>--}}
{{--                @endforeach--}}

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


                <div class="alert mt-4 alert-danger" role="alert"></div>
                <div id="tableWrapper">
                    <table class="table table-hover mt-4">
                        <thead>
                        <tr>
                            <th scope="col"><a id="nameSort" href="{{ $nameSortHref }}">Name </a>@if(request()->sort=='name'){!! request()->order=='asc'?'<i class="fas fa-arrow-up"></i>':'<i class="fas fa-arrow-down"></i>'!!} @endif</th>
                            <th scope="col"><a id="currencySort" href="{{ $currencySortHref }}">Currency </a>@if(request()->sort=='currency'){!! request()->order=='asc'?'<i class="fas fa-arrow-up"></i>':'<i class="fas fa-arrow-down"></i>' !!} @endif</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($clients as $client)
                            <tr>
                                {{--                        <th scope="row"><a class="btn btn-sm btn-secondary" href="#" role="button">Edit</a></th>--}}
                                <td>{{$client->name}}</td>
                                <td>{{$client->currency}}</td>
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
                    {{ $clients->links() }}
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



            </div>
        </div>
    </div>
@endsection
