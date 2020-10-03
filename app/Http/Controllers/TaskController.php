<?php

namespace App\Http\Controllers;

use App;
use Validator;
use App\Task;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task;
        $task->name = $request->name;
        $task->save();
    
        return redirect()->route('tasks.index')->with('success', trans('task.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if(!$task) return redirect()->route('tasks.index')->withErrors(trans('task.error'));
        $task->delete();

        return redirect()->route('tasks.index')->with('success', trans('task.success'));
    }
}
