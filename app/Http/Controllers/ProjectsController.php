<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Clients;
use App\Tasks;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        return view('projects.index', ['clients' => $clients]);
    }

    /**
     * To show the form to create projects.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        $tasks = Tasks::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        $users = User::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        return view('projects.create', ['clients' => $clients ,'tasks' => $tasks,'users' => $users]);
    }

    /**
     * To store projects.
     *
     * @return Response
     */
    public function store()
    {
        $clientsIdArray = Clients::select('id')->where('organisation_id', '=', Auth::user()->organisation->id)->get()->toArray();
        for($x=0;$x<count( $clientsIdArray);$x++) {
            $clientsIdArray[$x]=$clientsIdArray[$x]['id'];
        }

        request()->validate([
            'name'=>['required','min:2','max:255',Rule::unique('projects')->where(function ($query) {
                return $query->where('organisation_id', Auth::user()->organisation->id);})],
            'client'=>[Rule::in($clientsIdArray)],
            'team'=>['required'],
            'tasks'=>['required']
            ]);


        $project = new Projects;
        $project->name = request('name');
        $project->clients_id = request('client');
        $project->organisation_id = Auth::user()->organisation_id;
        $project->save();
        $project->users()->attach(request('team'));
        $project->tasks()->attach(request('tasks'));

//
//        $tasks =request('tasks');
//
//        $pos=count($tasks);
//        for ($x=0;$x<count($tasks);$x++) {
//            if (!is_numeric($tasks[$x])) {
//                $pos = $x;
//                break;
//            }
//        }
//
//        $tasksIds = array_slice($tasks,0, $pos);
//        $tasks2 = array_slice($tasks, $pos);
//        foreach ($tasks2 as $taskName) {
//            $task = new Tasks;
//            $task->name = $taskName;
//            $task->hourly_rate = 123;
//            $task->save();
//            $task->projects()->attach($project->id);
//        }
//        $project->tasks()->attach($tasksIds);


//        $project->roles = request('roles');
//        $project->capacity = request('capacity');
//        $project->billable_rate = request('billableRate');
//        $project->cost_rate = request('costRate');

        return redirect('/projects');


    }

    /**
     * To show the form to edit clients.
     *
     * @param  App\Projects  $project
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Projects $project)
    {
        $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        $tasks = Tasks::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        $users = User::where('organisation_id', '=', Auth::user()->organisation->id)->get();
        return view('projects.edit', ['project' => $project ,'clients' => $clients ,'tasks' => $tasks,'users' => $users]);
    }



    /**
     * To update project.
     *
     * @param  App\Projects  $project
     *
     * @return Response
     */
    public function update(Projects $project)
    {

        $clientsIdArray = Clients::select('id')->where('organisation_id', '=', Auth::user()->organisation->id)->get()->toArray();
        for($x=0;$x<count( $clientsIdArray);$x++) {
            $clientsIdArray[$x]=$clientsIdArray[$x]['id'];
        }

        request()->validate([
            'name'=>['required','min:2','max:255',Rule::unique('projects')->ignore($project->id)->where(function ($query) {
                return $query->where('organisation_id', Auth::user()->organisation->id);})],
            'client'=>[Rule::in($clientsIdArray)],
            'team'=>['required'],
            'tasks'=>['required']
        ]);

        $project->name = request()->name;
        $project->clients_id = request()->client;
        $project->save();
        $project->users()->sync(request('team'));
        $project->tasks()->sync(request('tasks'));


        return redirect('/projects');
    }




    /**
     * Remove a project from storage.
     *
     * @param  \App\Projects  $project
     * @return \Illuminate\Http\Response
     */
    public function delete(Projects $project)
    {
        $project->tasks()->detach();
        $project->delete();
        return redirect('/projects');
    }


}
