<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persons;

class PersonsController extends Controller
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
     * To index persons.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('articles.index', ['articles' => $articles] );
        //$clients = Clients::all();

       // $clients = Clients::latest()->get();
        return view('persons.index',['persons'=>Persons::latest()->get()] );
    }

    /**
     * To show the form to create persons.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('persons.create');
    }

    /**
     * To store persons.
     *
     * @return Response
     */
    public function store()
    {
        request()->validate([
            'personName'=>['required','min:2','max:255'],
            'email'=>['required','min:2','max:255'],
            'roles'=>['required','min:2','max:255'],
            'capacity'=>['required','numeric'],
            'billableRate'=>['required','numeric'],
            'costRate'=>['required','numeric']
            ]);

        //die('hee');
        //dump(request()->all());
        $person = new Persons;
        $person->name = request('personName');
        $person->email = request('email');
        $person->roles = request('roles');
        $person->capacity = request('capacity');
        $person->billable_rate = request('billableRate');
        $person->cost_rate = request('costRate');
        $person->save();
        return redirect('/team');

    }

    /**
     * To delete persons.
     *
     * @param  integer  $id
     *
     * @return Response
     */
    public function delete($id)
    {
        $person = Persons::findOrFail($id);
        $person->delete();
        return redirect('/team');

    }
}
