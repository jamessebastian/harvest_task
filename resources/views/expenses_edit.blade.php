@extends('layout')

@section('head')
    <link rel="stylesheet" type="text/css" href="/tasks.css">

@endsection

@section('content')
<div class="container" id="contentSection">
    <div class="row">
        <div class="col-8">
            @if(count($projects))
                <form class="mt-3" id="addExpenseForm" method="POST" action="/expenses/{{$expense->id}}">
                    @csrf
                    @method('PUT')
                    <h3><strong>Edit Expense</strong></h3>
                    <hr>

                    <div class="form-group row">
                        <label for="preferredCurrency" class="col-sm-2 col-form-label form-control-sm">Project</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="project" id="project">
                                @foreach($projects as $project)
                                    <option {{$expense->id == $project->id ? 'selected' : '' }} value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label form-control-sm">Category</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="category" id="category">
                                <option {{$expense->category == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                <option {{$expense->category == 'Lodging' ? 'selected' : '' }}>Lodging</option>
                                <option {{$expense->category == 'Meals' ? 'selected' : '' }}>Meals</option>
                                <option {{$expense->category == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                <option {{$expense->category == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label form-control-sm">Amount</label>
                        <div class="col-sm-4">
                            <input value="{{$expense->amount}}" type="text" name="amount" class="form-control" id="amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hourlyRate" class="col-sm-2 col-form-label form-control-sm">Date</label>
                        <div class="col-sm-4">
                            <input value="{{$expense->date}}" type="date" name="date" class="form-control" id="date">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label form-control-sm">Notes</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="notes" id="notes" rows="2">{{$expense->notes}}</textarea>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Expense</button>
{{--                            <a class="btn btn-secondary" href="#">Cancel</a>--}}
                        </div>
                    </div>
                </form>
            @else
                <h2>Add Project First</h2>
            @endif
        </div>
    </div>

</div>
@endsection
