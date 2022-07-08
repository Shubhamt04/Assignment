<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $this->validate($request, [
        //     'name' => 'required',
        //     'phone_number' => 'required|numeric|min:6|max:12',
        //     'email' => 'required',
        //     'country' => 'required|string',
        //     'country_code' => 'required',
        // ]);
        
        $student = Student::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'country' => $request->country,
            'country_code' => $request->country_code,
        ]);
        
        return response()->json([
            'student' => $student
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $columnsToSearch = ['name', 'email', 'phone_number', 'country', 'country_code'];

        $searchQuery = '%' . $request->search_term . '%';

        $students = Student::where('id', 'LIKE', $searchQuery);

        foreach($columnsToSearch as $column) {
            $students = $students->orWhere($column, 'LIKE', $searchQuery);
        }

        $students = $students->get();
        return response()->json([
            'search_data' => $students
        ]);
    }
}
