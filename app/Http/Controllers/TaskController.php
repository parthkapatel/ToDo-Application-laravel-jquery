<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false|\Illuminate\Http\Response|string
     */
    public function store(Request $request)
    {
        $newTask = new Task();
        $newTask->user_id = Auth::user()->id;
        $newTask->task_note = $request->task;
        $newTask->date = $request->date;
        $newTask->save();
        return json_encode(["status"=>"success","message"=>"Task Inserted Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return false|\Illuminate\Http\Response|string
     */
    public function update(Request $request, Task $task)
    {
        $task = Task::find($request->id);
        if($task){
            $task->status = "finished";
            $task->save();
            return json_encode(["status"=>"success","message"=>"Task Updated Successfully"]);
        }
        return json_encode(["status"=>"error","message"=>"something is wrong"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function getDataByActiveStatus(Request $request)
    {
        return Task::where("status",$request->status)->where("user_id",Auth::user()->id)->where("date",$request->date)->get();
    }
}
