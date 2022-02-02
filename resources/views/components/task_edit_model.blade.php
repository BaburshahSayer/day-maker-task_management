  <!-- Modal -->
  <div class="modal fade" id="task_edit_model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  method="PUT" id="task_edit_form">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="exampleFormControlInput1" class="form-label">Task Title</label>
                        <input type="text" name="task_title" class="form-control  {{$errors->has('task_title') ? ' is-invalid' : ''}}" value="{{old('task_title')}}" placeholder="Project">                              
                        
                            <div id="task_title_error" class="invalid-feedback">
                            </div>
                    </div>   
                    <div class="col-md-4">
                        <label for="project" class="form-label">Project</label>
                        <select class="form-select {{$errors->has('project_id') ? ' is-invalid' : ''}}" name="project_id" id="project_id" >
                            <option selected disabled value="">Choose...</option>

                            @foreach ($projects as $project)
                                
                                <option  value="{{ $project->id}}">{{$project->project_name}}</option>

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
                        <select class="form-select {{$errors->has('priority') ? ' is-invalid' : ''}}" id="priority" name="priority">
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
                    <input type="hidden" id="task_id">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary task_button" onclick="updateTask()">Update</button>

        </div>
      </div>
    </div>
  </div>