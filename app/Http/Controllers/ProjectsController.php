<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Clients;
use App\Tasks;
use App\Persons;

class ProjectsController extends Controller
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
     * To index projects.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients =  Clients::latest()->get();


       // dd($clients);
        return view('projects.index', ['clients' => $clients]);
    }

    /**
     * To show the form to create projects.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $clients = Clients::latest()->get();
        $tasks = Tasks::latest()->get();
        $persons = Persons::latest()->get();
        return view('projects.create', ['clients' => $clients ,'tasks' => $tasks,'persons' => $persons]);
    }

    /**
     * To store projects.
     *
     * @return Response
     */
    public function store()
    {

        request()->validate([
            'projectName'=>['required','min:2','max:255'],
            'client'=>['required','numeric'],
            'team'=>['required'],
            'tasks'=>['required']
            ]);


        $project = new Projects;
        $project->name = request('projectName');
        $project->clients_id = request('client');
        $project->save();
        $project->persons()->attach(request('team'));

        $tasks =request('tasks');

        $pos=count($tasks);
        for ($x=0;$x<count($tasks);$x++) {
            if (!is_numeric($tasks[$x])) {
                $pos = $x;
                break;
            }
        }

        $tasksIds = array_slice($tasks,0, $pos);
        $tasks2 = array_slice($tasks, $pos);
        foreach ($tasks2 as $taskName) {
            $task = new Tasks;
            $task->name = $taskName;
            $task->hourly_rate = 123;
            $task->save();
            $task->projects()->attach($project->id);
        }
        $project->tasks()->attach($tasksIds);


//        $project->roles = request('roles');
//        $project->capacity = request('capacity');
//        $project->billable_rate = request('billableRate');
//        $project->cost_rate = request('costRate');

        return redirect('/projects');










    }
}
