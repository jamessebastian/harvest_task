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

        let token = "<?php echo csrf_token(); ?>";
        let currentPageCount = 5;
        let nameSortOrder = 'asc';
        let currencySortOrder = 'asc';

    </script>

@endsection

@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">
            <div class="col-8">
                <h3>Manage clients</h3>
                <a class="btn btn-success btn-sm mb-3" href="clients/create" role="button"><strong>+ New Client</strong></a>

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
                    @include('clients.ajaxIndex')
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
