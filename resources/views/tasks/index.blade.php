@extends('layouts.app')
@section('content')
@section('title', 'Tasks')

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="task_button">
                Create Task
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{$errors->has('task_title') ? ' show' : 'hide'}} task_button" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body ">
                   
                        <form  method="POST" action="{{route('tasks.store')}}" id="task_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleFormControlInput1" class="form-label">Task Title</label>
                                    <input type="text" name="task_title" class="form-control  {{$errors->has('task_title') ? ' is-invalid' : ''}}" value="{{old('task_title')}}" placeholder="Task Title">                              
                                    @if($errors->has('task_title'))
                                        <div id="validationServer05Feedback" class="invalid-feedback">
                                            {{$errors->first('task_title')}}
                                        </div>
                                    @endif
                                </div>   
                                <div class="col-md-4">
                                    <label for="project" class="form-label">Project</label>
                                    <select class="form-select {{$errors->has('project_id') ? ' is-invalid' : ''}}" name="project_id">
                                        <option selected disabled value="">Choose...</option>

                                        @foreach ($projects as $project)
                                            
                                            <option  value="{{ $project->id}}" {{$project->id == old('project_id') ? ' selected="selected"' : ''}}>{{$project->project_name}}</option>

                                        @endforeach
                                     
                                    </select>
                                    @if($errors->has('project_id'))
                                        <div id="validationServer05Feedback" class="invalid-feedback">
                                            {{$errors->first('project_id')}}
                                        </div>
                                    @endif
                                  </div>                       
                                <div class="col-md-4">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select class="form-select {{$errors->has('priority') ? ' is-invalid' : ''}}"  name="priority">
                                      <option selected disabled value="">Choose...</option>
                                      <option value="0" {{old('priority') =='0' ? 'selected="selected"' : ''}}>Low</option>
                                      <option value="1" {{old('priority') =='1' ? 'selected="selected"' : ''}}>Normal</option>
                                      <option value="2" {{old('priority') =='2' ? 'selected="selected"' : ''}}>High</option>
                                    </select>
                                    @if($errors->has('priority'))
                                        <div id="validationServer05Feedback" class="invalid-feedback">
                                            {{$errors->first('priority')}}
                                        </div>
                                    @endif
                                  </div>                       
                                </div>
                                <div class="row pt-3">

                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary task_button" id="submit">Create Task </button>
                                    </div> 

                                </div>
                        </form>
                              
                </div>
            </div>
            </div>
        </div>
        <div class="row pt-2">
            {{-- New task data component --}}
            @component('components.task',compact('tasks'))    
   
                @slot('parent_id')
                    new_task
                @endslot
        
             @endcomponent

            {{-- In progress task data component --}}
             @component('components.task', compact('tasks'))    
   
                @slot('parent_id')
                    progress
                @endslot
            
             @endcomponent

            {{-- Completed task data component --}}
            @component('components.task', compact('tasks'))    
   
                @slot('parent_id')
                    completed
                @endslot

             @endcomponent 
    
         </div>
    </div>
</div>
    {{-- Task Edit component --}}
   @component('components.task_edit_model', compact('projects'))    
   
   @endcomponent 

@endsection
@push('js')
    <script>

        //drag and drop task jquery ajax
        //drag and drop js is taken from https://codepen.io/tsaiyy/pen/brKdGM?css-preprocessor=scss and customized 

        $(function() {
            $('.parent').on('click', 'section', function() {
                $(this).toggleClass('selected');
            });

            let task_status = '';
            let task_id = '';
            let task_type = '';

            $("div.parent").sortable({
                connectWith: 'div.parent',
                opacity: 0.6,
                revert: true,
                helper: function(e, item) {
                    task_id = item.context.id;
                    task_type = this.id;

                    if (!item.hasClass('selected'))
                        item.addClass('selected');
                    var elements = $('.selected').not('.ui-sortable-placeholder').clone();
                    var helper = $('<div/>');
                    item.siblings('.selected').addClass('hidden');
                    return helper.append(elements);
                },

                start: function(e, ui) {
                    var elements = ui.item.siblings('.selected.hidden').not('.ui-sortable-placeholder');
                    ui.item.data('items', elements);
                },
                receive: function(e, ui) {
                    ui.item.before(ui.item.data('items'));
                    task_status = $(this).attr('id');

                },
                stop: function(e, ui) {
                    ui.item.siblings('.selected').removeClass('hidden');
                    $('.selected').removeClass('selected');
                },
                update: function() {

                    updateTaskOrder(task_type);

                    if (task_status != '' && task_id != '') {

                        $.ajax({
                            type: "POST",
                            url: "{{ url('task_status') }}",
                            data: {
                                task_id,
                                task_status
                            },
                            success: function(response) {

                            }
                        });
                    }
                }

            });

            $("#new_task, #progress, #completed").disableSelection();
            $("#new_task, #progress, #completed").css('minHeight', $("#new_task, #progress").height() + "px");
        });

        function updateTaskOrder(task_type) {

            var ordered_task = [];

            $("#" + task_type + " section").each(function() {
                ordered_task.push($(this).attr('id'));
            });

            $.ajax({
                type: "POST",
                url: "{{ url('task_order') }}",
                data: {
                    ordered_task
                },
                success: function(response) {}
            });


        }

        function editTask(task_id){

            $.ajax({
                type: "GET",
                url: "{{ url('tasks') }}/"+task_id+"/edit",
                success: function(response) {

                $('[name="task_title"]').val(response.task.task_title);
                $('#priority').val(response.task.priority).change();
                $('#project_id').val(response.task.project_id).change();
                $('#task_id').val(response.task.id);
                $('[name="task_title"]').attr("required", "true");
                }
            });
        
        }

        function updateTask(){
            var task_id = $("#task_id").val();
            $.ajax({
                type: "PATCH",
                url: "{{ url('tasks') }}/"+task_id,
                data:$('#task_edit_form').serialize(),
                success: function(response) {
                    window.location.reload();
                },
                error: function (xhr) {

                    if(xhr.status === 422){
                        $('#task_title_error').show();
                        $('#task_title_error').html(xhr.responseJSON.errors["task_title"][0]);
                    }
            }
            });

        }

    </script>
@endpush
