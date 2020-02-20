<?php

namespace App\Http\Controllers;

use App\TimeSheet;
use Illuminate\Http\Request;

class TimeSheetController extends Controller
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
     * To index Time Sheets.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $timesheets = TimeSheet::latest()->get();
        return view('timesheet.submitted',['timesheets' => $timesheets]);
    }

}
