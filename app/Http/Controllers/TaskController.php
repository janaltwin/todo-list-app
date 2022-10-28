<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Task::all();
        return Task::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskFormRequest $request)
    {
        /*$request->validate([
            'name'=>'required|min:3|max:200',
            'details'=>'nullable',
            'category'=>'required', 
            'owner'=>'required'
        ]);*/

     
        return Task::create($request->all()); 
         
        

        /*return response([
            'message'=>'Task Added Succesfully!'
        ], 200);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskFormRequest $request, $id)
    {
        $tasks = Task::find($id);

        if($tasks){  

            $tasks->name = $request->name;
            $tasks->details = $request->details;
            $tasks->category = $request->category;
            $tasks->owner = $request->owner;

            $tasks->save();
            return Task::find($id); 
            /*return response([
                'message'=>'Task updated successfully'
            ], 200);*/
        }
        return response([
            'message'=>'Task does not exist!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::find($id);

        if($tasks){
            $tasks->destroy($id);
            return response([
                'message'=>'Task deleted successfully'
            ], 200);
        }
        return response([
            'message'=>'Task does not exist!'
        ], 404);
    }
    //{return Task::destroy($id); }

    /**
     * Search Task name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    //Search Task
    /*public function search($name)
    {
        return Task::where('name', 'like', '%' .$name.'%')->get();
    }*/
}
