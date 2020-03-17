<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
     * To index clients through ajax calls.
     *
     * @return json
     */
    public function ajaxIndex()
    {
        if(request()->search){

            if(request()->sort){
                $nameOrder = request()->sort=='name'?request()->order=='asc'?'desc':'asc':'asc';
                $nameSortHref = "/clients?search=".request()->search."&sort=name&order=".$nameOrder;
                $currencyOrder = request()->sort=='currency'?request()->order=='asc'?'desc':'asc':'asc';
                $currencySortHref = "/clients?search=".request()->search."&sort=currency&order=".$currencyOrder;

                $clients = Clients::where([
                    ['organisation_id', '=', Auth::user()->organisation->id],
                    ['name','like','%'.request()->search.'%']])
                    ->orderBy(request()->sort, request()->order)
                    ->paginate(5)
                    ->appends(['search' => request()->search,'sort' => request()->sort,'order' => request()->order ]);
            } else {
                $nameSortHref = "/clients?search=".request()->search."&sort=name&order=asc";
                $currencySortHref = "/clients?search=".request()->search."&sort=currency&order=asc";

                $clients = Clients::where([
                    ['organisation_id', '=', Auth::user()->organisation->id],
                    ['name','like','%'.request()->search.'%']])
                    ->paginate(5)
                    ->appends(['search' => request()->search]);
            }



        } else {


            if(request()->sort){
                $nameOrder = request()->sort=='name'?request()->order=='asc'?'desc':'asc':'asc';
                $nameSortHref = "/clients?sort=name&order=".$nameOrder;
                $currencyOrder = request()->sort=='currency'?request()->order=='asc'?'desc':'asc':'asc';
                $currencySortHref = "/clients?sort=currency&order=".$currencyOrder;

                $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)
                    ->orderBy(request()->sort, request()->order)
                    ->paginate(5)
                    ->appends(['sort' => request()->sort,'order' => request()->order]);
            } else {
                $nameSortHref = "/clients?sort=name&order=asc";
                $currencySortHref = "/clients?sort=currency&order=asc";

                $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)->paginate(5);
            }
        }

        $returnHTML = view('clients.ajaxIndex',['clients'=>$clients,'nameSortHref'=>$nameSortHref, 'currencySortHref'=>$currencySortHref])->render();
        return response()->json(['html'=>$returnHTML,'currentPageCount'=>$clients->count()]);

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
        if(request()->search){

            if(request()->sort){
                $nameOrder = request()->sort=='name'?request()->order=='asc'?'desc':'asc':'asc';
                $nameSortHref = "/clients?search=".request()->search."&sort=name&order=".$nameOrder;
                $currencyOrder = request()->sort=='currency'?request()->order=='asc'?'desc':'asc':'asc';
                $currencySortHref = "/clients?search=".request()->search."&sort=currency&order=".$currencyOrder;

                $clients = Clients::where([
                    ['organisation_id', '=', Auth::user()->organisation->id],
                    ['name','like','%'.request()->search.'%']])
                    ->orderBy(request()->sort, request()->order)
                    ->paginate(5)
                    ->appends(['search' => request()->search,'sort' => request()->sort,'order' => request()->order ]);
            } else {
                $nameSortHref = "/clients?search=".request()->search."&sort=name&order=asc";
                $currencySortHref = "/clients?search=".request()->search."&sort=currency&order=asc";

                $clients = Clients::where([
                    ['organisation_id', '=', Auth::user()->organisation->id],
                    ['name','like','%'.request()->search.'%']])
                    ->paginate(5)
                    ->appends(['search' => request()->search]);
            }



        } else {


            if(request()->sort){
                $nameOrder = request()->sort=='name'?request()->order=='asc'?'desc':'asc':'asc';
                $nameSortHref = "/clients?sort=name&order=".$nameOrder;
                $currencyOrder = request()->sort=='currency'?request()->order=='asc'?'desc':'asc':'asc';
                $currencySortHref = "/clients?sort=currency&order=".$currencyOrder;

                $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)
                    ->orderBy(request()->sort, request()->order)
                    ->paginate(5)
                    ->appends(['sort' => request()->sort,'order' => request()->order]);
            } else {
                $nameSortHref = "/clients?sort=name&order=asc";
                $currencySortHref = "/clients?sort=currency&order=asc";

                $clients = Clients::where('organisation_id', '=', Auth::user()->organisation->id)->paginate(5);
            }
        }

        return view('clients.index',['clients'=>$clients,'nameSortHref'=>$nameSortHref, 'currencySortHref'=>$currencySortHref] );
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
        $validatedValues = request()->validate([
            'name'=>['required','regex:/^(\s*[A-Za-z]\w*\s*)*$/','min:2','max:255',Rule::unique('clients')->where(function ($query) {
                return $query->where('organisation_id', Auth::user()->organisation->id);})],
            'address'=>'required',
            'currency'=>[Rule::in(['INR', 'USD','EUR','AUD','CAD','JPY'])],
            ]);

        Clients::create($validatedValues+['organisation_id'=>Auth::user()->organisation->id]);
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
       // $this->authorize('update',$client);
//chumma 2
        $validatedValues = request()->validate([
            'name'=>['required','regex:/^(\s*[A-Za-z]\w*\s*)*$/','min:2','max:255',Rule::unique('clients')->ignore($client->id)->where(function ($query) {
                return $query->where('organisation_id', Auth::user()->organisation->id);})],
            'address'=>'required',
            'currency'=>['required',Rule::in(['INR', 'USD','EUR','AUD','CAD','JPY'])],
        ]);

        $client->update($validatedValues);
        return redirect('/clients');
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
