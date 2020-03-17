<?php

namespace App\Http\Controllers;

use App\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganisationController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.organisation.edit',['organisation' => Auth::user()->organisation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //ddd($request->all());
        $validatedValues = $request->validate([
            'name'=>['required','regex:/^(\s*[A-Za-z]\w*\s*)*$/','min:2','max:255','unique:organisations'],
        ]);
        $organisation = Auth::user()->organisation;
        $organisation->update($validatedValues);
        return redirect('/tasks');
    }

}
