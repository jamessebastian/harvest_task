@extends('layout')

@section('head')
    <link rel="stylesheet" type="text/css" href="/tasks.css">

@endsection

@section('tail')
    <script src="/expense.js"></script>
@endsection

@section('content')
    <div class="container" id="contentSection">
        <div class="row">
            <div class="col-8">
                <button id="addExpenseButton" onclick="showForm()" class="btn btn-primary ">+ Add Expense</button>
                @if(count($projects))
                    <form class="mt-3" id="addExpenseForm" method="POST" action="/expenses">
                        @csrf
                        <h3><strong>Add New Expense</strong></h3>
                        <hr>

                        <div class="form-group row">
                            <label for="preferredCurrency" class="col-sm-2 col-form-label form-control-sm">Project</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="project" id="project">
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label form-control-sm">Category</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="category" id="category">
                                    <option>Entertainment</option>
                                    <option>Lodging</option>
                                    <option>Meals</option>
                                    <option>Transportation</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label form-control-sm">Amount</label>
                            <div class="col-sm-4">
                                <input type="text" name="amount" class="form-control" id="amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hourlyRate" class="col-sm-2 col-form-label form-control-sm">Date</label>
                            <div class="col-sm-4">
                                <input type="date" name="date" class="form-control" id="date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label form-control-sm">Notes</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="notes" id="notes" rows="2"></textarea>
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Save Expense</button>
                                <a class="btn btn-secondary" onclick="hideForm()" href="#">Cancel</a>
                            </div>
                        </div>
                    </form>
@else
                    <h2>Add Project First</h2>
@endif
            </div>
        </div>
@if(isset($expensesCollection) && (count($expensesCollection)))


        @foreach($expensesCollection as $expenses)
        <br>
        <hr style="background-color: gray;">
                <div class="row">
                    <div class="col-3">
                        <h4>
                            @if(Carbon\Carbon::parse($expenses->first()->date)->startOfWeek()->format('Y') ==   Carbon\Carbon::parse($expenses->first()->date)->endOfWeek()->format('Y'))
                            {{Carbon\Carbon::parse($expenses->first()->date)->startOfWeek()->format('jS F')}}  -
                            @else
                              {{Carbon\Carbon::parse($expenses->first()->date)->startOfWeek()->format('jS F Y')}}  -
                            @endif
                            <br>
                            {{ Carbon\Carbon::parse($expenses->first()->date)->endOfWeek()->format('jS F y') }}
                        </h4>

                    </div>
                    <div class="col-8">
                    <table class="table">
                      <tbody>
                      <?php $sum=0; ?>
                      @foreach($expenses as $expense)
                          <?php $sum=$sum+$expense->amount;  ?>
                        <tr>
                          <td>{{Carbon\Carbon::parse($expense->date)->format('jS F Y')}}</td>
                          <td>{{$expense->projects->name}} ( {{$expense->projects->clients->name}} )<br>{{$expense->category}}</td>
                          <td><strong>₹ {{$expense->amount}}</strong></td>
                          <td><a class="btn-info mr-2 btn btn-sm" href="expenses/{{$expense->id}}/edit">Edit</a>
                              <form style="display: inline;" method="POST" action="expenses/{{$expense->id}}">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn-danger btn btn-sm" type="submit">Delete</button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                      <tr>
                          <td></td>
                          <td></td>
                          <td> <strong>Total: {{$sum}}</strong></td>
                          <td></td>
                      </tr>
                      </tbody>
                    </table>
                    </div>
                </div>
            @endforeach
@endif
    </div>
@endsection
