<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select('id','project_name')->get();
        $tasks=Task::orderByDesc('order')->get();
  
        
        return view('tasks.index',compact('projects','tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {   
       
            
            Task::create($request->all());

          

        return redirect()->back()->with('success', 'Task Created successfully');

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
        $projects = Project::all();
        return [
            'task' => $task,
            'projects' => $projects
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

         $task->delete();
         return redirect()->back()->with('success', 'Task deleted successfully');

    }

    public function TaskStatus(Request $request){

        //update task status if we drag fron one column to another
        $task=Task::find($request->task_id);

        switch ($request->task_status){
            case 'new_task':
                $new_status='0';
            break;
            case 'progress':
                $new_status='1';
            break;
            case 'completed':
                $new_status='2';
            break;
        }

        $request['status']=$new_status;

        $task->update($request->all());

        $tasks= Task::whereStatus($new_status)->get();
      
        return $task;
    }

    public function TaskOrder(Request $request){

        //Task order will setup if we drag top or bottom 

        $ordered_task = array_reverse($request->ordered_task);

        foreach($ordered_task as $index => $order){

            $index = $index+1;

            $task = Task::find($order)->update(['order'=>$index]);
        }
    }
}
