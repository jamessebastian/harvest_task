<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rules\asdasd;

class TestController extends Controller
{
    public function test(Request $request,$wildcard)
    {
        $rules = [
            'name' => ['required',new asdasd],
        ];

        $attributes =  [
        'name' => 'Full Name',
        ];

        $customMessages = [
            'name.required'  => 'say your name',
            'name.min' => ' :attribute minimuuuummmm',
         ];

        $this->validate($request, $rules, $customMessages , $attributes);

        return back()->with("status", "Your message has been received, We'll get back to you shortly.");
    }
}
