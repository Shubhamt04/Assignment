<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonPostRequest;
use App\Models\Person;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = Person::paginate(2);
        return view('person.index', compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonPostRequest $request)
    {
        try {
            $validateData = $request->validated();
            $fileName = 'background.jpeg'; // Default image

            if($request->hasFile('profile_image')){
                $fileName = time().'.'.$request->file('profile_image')->getClientOriginalName(); 
                $request->file('profile_image')->move(public_path('uploads'), $fileName);
            }

            $person = Person::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'country' => $request->country,
                'profile_image' => $fileName,
            ]);

            if(!is_null($person)) { 
                return back()->with("success", "Person Created Successfully");
            } else {
                return back()->with("failed", "Failed to create person. Try again.");
            }
        } catch(Exception $e){
            Log::channel('person')->error('There is some error occured while adding new person', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
        
    }

    /**
     * Search person based on requested search term.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $columnsToSearch = ['name', 'email', 'phone_number', 'country'];
            $searchQuery = '%' . $request->search . '%';
            $person = Person::where('id', 'LIKE', $searchQuery);

            foreach($columnsToSearch as $column) {
                $person = $person->orWhere($column, 'LIKE', $searchQuery);
            }

            $persons = $person->paginate(2);
            $persons->appends($request->all());

            return view('person.index', compact('persons'));
        } catch(Exception $e){
            Log::channel('person')->error('There is some error occured while doing search query', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);

        return view('person.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonPostRequest $request, $id)
    {
        try {
            $validateData = $request->validated();
            $person = Person::find($id);

            if($request->hasFile('profile_image')){
                $oldFilePath = public_path('uploads'.$person->profile_image);
                
                if(file_exists($oldFilePath)){
                    unlink($oldFilePath);
                }
                
                $fileName = time().'.'.$request->file('profile_image')->getClientOriginalName(); 
                $request->file('profile_image')->move(public_path('uploads'), $fileName);
                $person->profile_image = $fileName;
            }

            $person->name = $request->name;
            $person->phone_number = $request->phone_number;
            $person->email = $request->email;
            $person->country = $request->country;
            $person->update();

            if(!is_null($person)) { 
                return back()->with("success", "Person Updated Successfully");
            } else {
                return back()->with("failed", "Failed to updated person. Try again.");
            }
        } catch(Exception $e){
            Log::channel('person')->error('There is some error occured while doing search query', ['message' => $e->getMessage()]);
            return back()->with("failed", "Failed to updated person. Try again.");
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $person = Person::find($id);
            $person->delete();

            return redirect()->route('persons.index')
            ->with('success','Person has been deleted successfully');
        } catch(Exception $e){
            Log::channel('person')->error('There is some error occured while deleting person', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => $e
            ]);
        }
    }
}
