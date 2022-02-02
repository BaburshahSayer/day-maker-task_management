@extends('layouts.app')
@section('content')
@section('title', 'Projects')

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Create Project
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse {{$errors->has('project_name') ? ' show' : 'hide'}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body ">
                    <div class="col-sm-6 center">
                        <form  method="POST" action="{{route('projects.store')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Project</label>
                                <input type="text" name="project_name" class="form-control  {{$errors->has('project_name') ? ' is-invalid' : ''}}" placeholder="Project">                              
                                @if($errors->has('project_name'))
                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                        {{$errors->first('project_name')}}
                                    </div>
                                @endif
                            </div>                                                   
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Create Project</button>
                            </div>   
                        </form>
                    </div>                     
                </div>
            </div>
            </div>
        </div>
        <div class="pt-2">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $index=>$project)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$project->project_name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

          {{$projects->links()}}

        </div>
    </div>
</div>
      
@endsection
