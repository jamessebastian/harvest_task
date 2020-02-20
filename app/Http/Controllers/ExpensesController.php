<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expenses;
use App\Projects;
use App\TimeSheet;

use Carbon\Carbon;


class ExpensesController extends Controller
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
     * To index expenses.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//    $current = Carbon::now();$today = Carbon::today();
////$current = new Carbon();
//dd($today);
        $exp=Expenses::orderBy('date','DESC')->get()
            ->groupBy(function($date){return Carbon::parse($date->date)->format('Y W');});

        return view('expenses', ['expensesCollection' => $exp,'projects' => Projects::all()]);
    }

    /**
     * To store expenses.
     *
     * @return Response
     */
    public function store()
    {
        request()->validate([
            'category'=>['required','min:2','max:255'],
            'amount'=>['required','numeric'],
            'project'=>['required','numeric'],
            'date' =>['required','date']
        ]);

        //$timeSheet = TimeSheet::where([['start_date','=',request('date')],['end_date','<',request('date')]])->get()->first();
        //$timeSheet = TimeSheet::whereBetween(request('date'),['start_date','end_date'])->get();

        $startOfWeek = Carbon::parse(request('date'))->startOfWeek()->format('Y-m-d');
        $endOfWeek  = Carbon::parse(request('date'))->endOfWeek()->format('Y-m-d');

        $timeSheet = TimeSheet::where([['start_date','=',$startOfWeek],['end_date','=',$endOfWeek]])->get()->first();

        if(!$timeSheet){
            $timeSheet = new TimeSheet;
            $timeSheet->start_date = $startOfWeek;
            $timeSheet->end_date = $endOfWeek;
            $timeSheet->user_id = \Auth::user()->id;
            $timeSheet->save();
        }

        $expense = new Expenses;

        $expense->time_sheets_id = $timeSheet->id;

        $expense->users_id=\Auth::user()->id;
        $expense->amount = request('amount');
        $expense->projects_id = request('project');
        $expense->category = request('category');
        $expense->notes = request('notes');
        $expense->date = request('date');


        $expense->save();
        return redirect('/expenses');

    }

    /**
     * To show the form to edit expenses.
     *
     * @param  integer  $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $expense = Expenses::findOrFail($id);
        return view('expenses_edit', ['expense' => $expense , 'projects' => Projects::all()]);
    }

    /**
     * To update expenses.
     *
     * @param  integer  $id
     *
     * @return Response
     */
    public function update($id)
    {
//        request()->validate([
//            'taskName'=>['required','min:2','max:255'],
//            'hourlyRate'=>['required','numeric']
//        ]);

        $startOfWeek = Carbon::parse(request('date'))->startOfWeek()->format('Y-m-d');
        $endOfWeek  = Carbon::parse(request('date'))->endOfWeek()->format('Y-m-d');

        $timeSheet = TimeSheet::where([['start_date','=',$startOfWeek],['end_date','=',$endOfWeek]])->get()->first();

        if(!$timeSheet){
            $timeSheet = new TimeSheet;
            $timeSheet->start_date = $startOfWeek;
            $timeSheet->end_date = $endOfWeek;
            $timeSheet->user_id = \Auth::user()->id;
            $timeSheet->save();
        }

        $expense = Expenses::findOrFail($id);
        $expense->time_sheets_id = $timeSheet->id;

        $expense->amount = request('amount');
        $expense->projects_id = request('project');
        $expense->category = request('category');
        $expense->notes = request('notes');
        $expense->date = request('date');
        $expense->save();
        return redirect('/expenses');
    }


    /**
     * To delete expenses.
     *
     * @return Response
     */
    public function delete($id)
    {
        $expense = Expenses::findOrFail($id);
        $expense->delete();
        return redirect('/expenses');
    }

}
