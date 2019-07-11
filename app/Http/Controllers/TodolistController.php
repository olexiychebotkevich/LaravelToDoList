<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TodolistController extends Controller
{
    public function AddTask(Request $request)
    {
      
        $currentUserId = app('Illuminate\Contracts\Auth\Guard')->user()->id;
     
        request()->validate([
            'text' => 'required',
            'done' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = $currentUserId;
        $id=Task::create($data)->id;
        $addedtask= Task::find($id);
       
       
  
    return response()->json($addedtask); 
    }


    public function GetTasks()
    {
        $currentUserId = app('Illuminate\Contracts\Auth\Guard')->user()->id;
        $tasks = Task::where('user_id', '=', $currentUserId)->get();
        return response()->json($tasks);
        
    }


    public function DeleteTask(Request $request)
    {
        $id=$request->deleteid;
        Task::destroy($id);
        $response = array(
        'status' => 'success',
        'deletedid'=>$id
       );
        return response()->json($response); 
    }


    public function CheckDone(Request $request)
    {

        // request()->validate([
        //     'text' => 'required',
        //     'done' => 'required',
        // ]);
        Task::where('id', '=', $request->id)->update(array('done' => $request->done));

        $response = array(
            'status' => 'success'
           );
         return response()->json($response); 
    }
}
