<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
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
     * To index clients.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('articles.index', ['articles' => $articles] );
        //$clients = Clients::all();

        $clients = Auth::user()->organisation->clients;
        return view('clients.clients',['clients'=>$clients] );
    }

    /**
     * To show the form to create clients.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * To show the form to edit clients.
     *
     * @param  App\Clients  $client
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Clients $client)
    {
        //$client = Clients::findOrFail($id);
        return view('clients.edit',compact('client'));
    }

    /**
     * To store clients.
     *
     * @return Response
     */
    public function store()
    {
        Clients::create($this->validateClient()+['organisation_id'=>Auth::user()->organisation->id]);
        return redirect('/clients');
    }

    /**
     * To update clients.
     *
     * @param  App\Clients  $client
     *
     * @return Response
     */
    public function update(Clients $client)
    {
        $client->update($this->validateClient());
        return redirect('/clients');
    }


    /**
     * Validates client details.
     *
     * @return Array
     */
    protected function validateClient()
    {

        return request()->validate([
            'name'=>['required','min:2','max:255'],
            'address'=>'required',
            'currency'=>'required']);
    }

//    public function delete($id)
//    {
//        Clients::findOrFail($id)->delete();
//        return redirect('/clients');
//

//    }
    /**
     * To delete clients using Ajax requests.
     *
     * @param  App\Clients  $client
     *
     * @return json
     */
    public function ajaxDelete(Clients $client)
    {
        $clientName= $client->name;
        $client->delete();
        return response()->json(array('msg'=> $clientName." has been deleted."), 200);
    }
}
