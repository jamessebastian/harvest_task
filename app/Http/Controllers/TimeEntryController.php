<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Projects;
use App\Time_entry;
use App\TimeSheet;
use Carbon\Carbon;

class TimeEntryController extends Controller
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
     * Redirects to current date
     *
     * @return Response
     */
    public function redirectToToday()
    {
        return redirect('/time/'.Carbon::now()->format('Y/m/d'));
    }


    /**
     * Returns an array of dates of the week.
     *
     * @param  date  $date
     *
     * @return array
     */
    protected function weekDays($date)
    {
        $week = array();

        for($x=1;$x<=7;$x++)
        {
            $date2 = Carbon::parse($date->format('Y-m-d'));
            $week[] = $date2->addDays($x - $this->weekNumber($date2->dayOfWeek))->format('Y/m/d');
        }
        return $week;
    }


    /**
     * Returns customised week number.
     *
     * @param  integer  $weekNumber
     *
     * @return integer
     */
    protected function weekNumber($weekNumber)
    {
        if($weekNumber == 0)
        {
            return 7;
        }
        return $weekNumber;
    }

    /**
     * To index Time Entries.
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($year,$month,$day)
    {
        try {
            $dt = Carbon::parse($year.'-'.$month.'-'.$day);
        }
        catch (\Exception $err) {
            abort('404');
        }

        $tasks = Tasks::latest()->get();
        $projects = Projects::latest()->get();
        $entries = Time_entry::latest()->where([['date','=',$dt->toDateString()]])->get();
        $weekDays = $this->weekDays($dt);

        return view('time' ,['tasks'=>$tasks,'projects'=>$projects,'date'=>$dt,'entries'=>$entries,'weekDays'=>$weekDays]);
    }

   /**
     * To store time entry.
     *
     * @return Response
     */
    public function store()
    {
        request()->validate([
            'timeInHours'=>['required','numeric','min:0','max:24']
        ]);



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

        $time_entry = new Time_entry;
        $time_entry->time_sheets_id = $timeSheet->id;
//        $timeSheet->total_hours+=request('timeInHours');
        $time_entry->time = request('timeInHours');
        $time_entry->notes = request('notes');
        $time_entry->date = request('date');

        $time_entry->users_id=\Auth::user()->id;
        $time_entry->projects_id = request('project');
        $time_entry->tasks_id = request('task');

        $time_entry->save();

        return redirect('/time/'.Carbon::parse(request('date'))->format('Y/m/d'));

    }

    /**
     * To delete time entry.
     *
     * @param  integer  $id
     *
     * @return Response
     */
    public function delete($id)
    {
        Time_entry::findOrFail($id)->delete();
        return redirect('/time');
    }



}
