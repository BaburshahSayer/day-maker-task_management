<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        @php
            if ($parent_id == 'new_task'){

                    $status="0";
                    $class="bg-info";
                    $title="New Task";

            }elseif($parent_id == 'progress'){

                    $status="1";
                    $class="bg-primary";
                    $title="In Progress";

            }elseif($parent_id == 'completed'){

                   $status="2";
                   $class="bg-success";
                   $title="Completed";
          }
        @endphp
        <div class="card-header {{$class}} text-white text-center">
            {{$title}}
        </div>
 
        <div id="{{$parent_id}}" class="parent">
            @foreach ($tasks->where('status', $status) as $index => $task)
                <section class="border-bottom child" id="{{$task->id}}">
                    <div class="row p-2 pb-0">
                        <div class="col-md-10">
                            <span class="label label-gray fs-5">{{$task->task_title}}</span>                                
                        </div>
                        <div class="col-md-2 float-end">
                            <div class="dropdown">
                                <a class="btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> </a>                                           
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="editTask({{$task->id}})"  data-bs-toggle="modal" data-bs-target="#task_edit_model">Edit</a></li>
                                    <form method='POST' action="{{route('tasks.destroy',$task)}}">
                                        @csrf
                                        @method('DELETE')
                                         <li><button type="submit" class="dropdown-item">Delete</button></li>
                                    </form>
                                </ul>
                            </div>                                        
                        </div>                                   
                    </div>
                    <div class="row p-2 pt-0">
                        <div class="col-md-12">
                            @if ($task->priority == '0')
                                <span class="badge bg-primary text-white">Low</span>
                            @elseif ($task->priority == '1')    
                                <span class="badge bg-warning text-white">Normal</span>
                            @elseif ($task->priority == '2')    
                                <span class="badge bg-danger text-white">High</span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            
                            <strong class="task-description">Project: </strong>
                            <span class="label label-gray task-description">
                                 {{$task->project->project_name}}
                            </span>
                            <br>
                            <strong class="task-description">Created: </strong>
                            <span class="label label-gray task-description">
                                {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->created_at)->format('Y-m-d')}}
                            </span>
                            
                        </div>
                    </div>
                </section>
            @endforeach
         </div>
  
        </div>                                    
   </div>