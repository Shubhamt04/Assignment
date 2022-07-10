<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentPostRequest;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentPostRequest $request)
    {
        try{
            $validated = $request->validated();
            $student = Student::create($validated);
            return response()->json([
                'student' => $student,
            ]);
        } catch(Exception $e){
            Log::channel('student')->error('There is some error occured while creating student', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
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
        } catch(Exception $e){
            Log::channel('student')->error('There is some error occured while searching student', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
        
    }
}
