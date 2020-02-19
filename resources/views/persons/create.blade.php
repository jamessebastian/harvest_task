@extends('layout')


@section('content')
    <div class="container" id="contentSection">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <h3><strong>Add Person</strong></h3>
{{--                <p>We’ll email this person an invitation to your Harvest account.</p>--}}
                <hr>
                <form method="POST" action="/person">
                    @csrf
                    <div class="form-group row">
                        <label for="personName" class="col-sm-2 col-form-label form-control-sm">Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="personName" class="form-control" id="personName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label form-control-sm">Work Email</label>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row mb-0">
                        <label for="roles" class="col-sm-2 col-form-label form-control-sm">Roles</label>
                        <div class="col-sm-6">
                            <input type="text" name="roles" class="form-control" id="roles">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 grayFont">
                            <small>Roles are just descriptors for your teammates, like Designer, Senior, NYC, etc.
                                They’ll help organize your Team Overview and reports.</small>
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-3">
                        <label for="capacity" class="col-sm-2 col-form-label form-control-sm">Capacity</label>
                        <div class="col-sm-2">
                            <input type="text" name="capacity" class="form-control" id="capacity">
                        </div>
                        <div class="pl-0 col-5">Hour</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 grayFont">
                            <small>The number of hours per week this person is available to work.</small>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row mb-0">
                        <label for="billableRate" class="col-sm-2 col-form-label form-control-sm">Billable Rate</label>
                        <div class="col-sm-2">
                            <input type="text" name="billableRate" class="form-control" id="billableRate">
                        </div>
                        <div class="pl-0 col-5">Rupees Per hour</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 grayFont">
                            <small>The rate you bill clients for this person’s time. You can override this rate on each project.
                                Only administrators and project managers with permission to view rates can see this rate.</small>
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-3">
                        <label for="costRate" class="col-sm-2 col-form-label form-control-sm">Cost Rate</label>
                        <div class="col-sm-2">
                            <input type="text" name="costRate" class="form-control" id="costRate">
                        </div>
                        <div class="pl-0 col-5">Rupees Per hour</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 grayFont">
                            <small>The internal cost that this person incurs on your business.
                                Only administrators can see this rate.</small>
                        </div>
                    </div>








                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Save Person</button>
                            <a class="btn btn-secondary" href="/team">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection
