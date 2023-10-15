<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Patient;
use App\Models\Town;

class PatientController extends Controller
{
    public function index()
    {
        $towns = Town::all();
        $county = County::all();
        $data = [
            'towns' => $towns,
            'counties' => $county,
        ];
        return view('sanitorium.register', $data);
    }

    public function create()
    {
        if(Auth()->user()){
            $name=Auth()->user()->name;
        }
        else{
            $name='Unknown';
        }
        Patient::create([
           'name' => request()->name,
            'contact' => request()->email,
            'email' => request()->contact,
            'gender' => request()->gender,
            'location' =>(request()->town).', '.(request()->county),
            'age_group'=>request()->agegroup,
            'condition'=>request()->condition,
            'prefered_service'=>request()->pref_service,
            'logged_by'=>$name
        ]);
        return redirect('/lifestyle');
    }
    public function store()
    {
        //
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
