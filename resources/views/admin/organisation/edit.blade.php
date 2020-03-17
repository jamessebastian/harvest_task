@extends('layout')

@section('title')
<title>Edit Organisation</title>
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="/tasks.css">
@endsection



@section('content')
    <div class="container" id="contentSection">
        <div class="row justify-content-center">

            <div class="col-8">
                <form id="editOrganisation" method="POST" action="/admin/edit-organisation">
                    @csrf
                    @method('PUT')
                    <h3><strong>Edit Organisation:<span style="font-style: italic;">  {{ $organisation->name }}</span></strong></h3>
                    <hr>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label form-control-sm">Organisation Name <span class="red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ $organisation->name }}" id="name">
                            <small id="nameErr" class="red">{{$errors->first('name')}}</small>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
