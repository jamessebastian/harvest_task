<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Gate;
use Illuminate\Support\Facades\Auth;

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
        $tasks = Auth::user()->organisation->tasks;
        return view('tasks', compact('tasks'));
    }


    /**
     * To store tasks.
     *
     * @return Response
     */
    public function store()
    {
        Tasks::create( $this->validateTask()+['organisation_id'=>Auth::user()->organisation->id]);
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
        $task->update( $this->validateTask());
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

    /**
     * Validates task details.
     *
     * @return Array
     */
    protected function validateTask()
    {
        return request()->validate([
            'name'=>['required','min:2','max:255'],
            'hourly_rate'=>['required','numeric']]);
    }

}
