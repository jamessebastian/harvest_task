<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * To index tasks.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        Gate::authorize('task.viewAny');


        if(request()->search){

            if(request()->sort){
                $nameOrder = request()->sort=='name'?request()->order=='asc'?'desc':'asc':'asc';
                $nameSortHref = "/tasks?search=".request()->search."&sort=name&order=".$nameOrder;
                $hourlyRateOrder = request()->sort=='hourly_rate'?request()->order=='asc'?'desc':'asc':'asc';
                $hourlyRateSortHref = "/tasks?search=".request()->search."&sort=hourly_rate&order=".$hourlyRateOrder;

                $tasks = Tasks::where([
                    ['organisation_id', '=', Auth::user()->organisation->id],
                    ['name','like','%'.request()->search.'%']])
                    ->orderBy(request()->sort, request()->order)
                    ->paginate(5)
                    ->appends(['search' => request()->search,'sort' => request()->sort,'order' => request()->order ]);
            } else {
                $nameSortHref = "/tasks?search=".request()->search."&sort=name&order=asc";
                $hourlyRateSortHref = "/tasks?search=".request()->search."&sort=hourly_rate&order=asc";

                $tasks = Tasks::where([
                    ['organisation_id', '=', Auth::user()->organisation->id],
                    ['name','like','%'.request()->search.'%']])
                    ->paginate(5)
                    ->appends(['search' => request()->search]);
            }



        } else {


            if(request()->sort){
                $nameOrder = request()->sort=='name'?request()->order=='asc'?'desc':'asc':'asc';
                $nameSortHref = "/tasks?sort=name&order=".$nameOrder;
                $hourlyRateOrder = request()->sort=='hourly_rate'?request()->order=='asc'?'desc':'asc':'asc';
                $hourlyRateSortHref = "/tasks?sort=hourly_rate&order=".$hourlyRateOrder;

                $tasks = Tasks::where('organisation_id', '=', Auth::user()->organisation->id)
                    ->orderBy(request()->sort, request()->order)
                    ->paginate(5)
                    ->appends(['sort' => request()->sort,'order' => request()->order]);
            } else {
                $nameSortHref = "/tasks?sort=name&order=asc";
                $hourlyRateSortHref = "/tasks?sort=hourly_rate&order=asc";

                $tasks = Tasks::where('organisation_id', '=', Auth::user()->organisation->id)->paginate(5);
            }
        }

        return view('tasks',['tasks'=>$tasks,'nameSortHref'=>$nameSortHref, 'hourlyRateSortHref'=>$hourlyRateSortHref] );
    }


    /**
     * To store tasks.
     *
     * @return Response
     */
    public function store()
    {
        $validatedValues = request()->validate([
            'name'=>['required','min:2','max:255',Rule::unique('tasks')->where(function ($query) {
                return $query->where('organisation_id', Auth::user()->organisation->id);})],
            'hourly_rate'=>['required','numeric']]);

        Tasks::create( $validatedValues+['organisation_id'=>Auth::user()->organisation->id]);
        return redirect('/tasks');

    }

    /**
     * To show the form to edit tasks.
     *
     * @param  App\Tasks  $task
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Tasks $task)
    {
       // $task = Tasks::findOrFail($id);
        return view('tasks_edit',compact('task'));
    }

    /**
     * To update tasks.
     *
     * @param  App\Tasks  $task
     *
     * @return Response
     */
    public function update(Tasks $task)
    {
        $validatedValues = request()->validate([
            'name'=>['required','min:2','max:255',Rule::unique('tasks')->ignore($task->id)->where(function ($query) {
                return $query->where('organisation_id', Auth::user()->organisation->id);})],
            'hourly_rate'=>['required','numeric']]);

        $task->update($validatedValues);
        return redirect('/tasks');
    }

//    public function delete(Tasks $task)
//    {
//        $task->delete();
//        return redirect('/tasks');
//    }

    /**
     * To delete tasks using Ajax requests.
     *
     * @param  App\Tasks  $task
     *
     * @return json
     */
    public function ajaxDelete(Tasks $task)
    {
        $taskName= $task->name;
        $task->delete();
        return response()->json(array('msg'=> $taskName." has been deleted."), 200);
    }


}
