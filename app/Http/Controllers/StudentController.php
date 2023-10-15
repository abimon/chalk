<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Student;
use App\Models\Town;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $towns = Town::all();
        $county = County::all();
        $data = [
            'towns' => $towns,
            'counties' => $county,
        ];
        return view('student.register', $data);
    }
    public function create()
    {
        if (Auth()->user()) {
            $name = Auth()->user()->name;
        } else {
            $name = 'Unknown';
        }
        Student::create([
            'name' => request()->name,
            'contact' => request()->contact,
            'email' => request()->email,
            'gender' => request()->gender,
            'location' => (request()->town) . ', ' . request()->county,
            'age_group' => request()->agegroup,
            'cohort' => request()->cohort,
            'loggedby' => $name
        ]);
        return redirect('/lifestyle');
    }
    public function store(Request $request)
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
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
