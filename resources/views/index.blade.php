@extends('layout')

@section('main-content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">Welcome Back, {{Auth::user()->name}}</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('task.create') }}" class="btn btn-info">
               <i class="fa fa-plus-circle"></i> Create Task
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    @foreach ($tasks as $task)
        <div class="card mt-3">
            <h4 class="card-header">
                @if ($task->status === 'Todo')
                    {{ $task->name }}
                @else
                    <del>{{ $task->name }}</del>
                @endif

                </span>
            </h4>

            <div class="card-body">
                <div class="card-text">
                    <div class="float-start">
                        <h5>
                        @if ($task->status === 'Todo')
                            {{ $task->description }}
                            <br>
                            Due Date: {{ $task->due_date }}
                            <br>
                            File: 
                            <a href="files/{{ $task->filename }}"> {{ $task->filename }}</a>
                        @else
                            <del>{{ $task->description }}</del>
                        @endif
                        </h5>
                        <br>

                        @if ($task->status === 'Todo')
                            <span class="badge rounded-pill bg-info text-dark">
                                Todo
                            </span>
                        @else
                            <span class="badge rounded-pill bg-success text-white">
                                Done
                            </span>
                        @endif


                        <small>Last Updated - {{ $task->updated_at->diffForHumans() }} </small>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                           <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('task.done', $task->id) }}" style="display: inline" method="POST" onsubmit="return confirm('Are you sure to mark as done ?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-success">
                                 <i class="fa fa-check"></i> Done
                            </button>
                        </form>
                        <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST" onsubmit="return confirm('Are you sure to delete ?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endforeach

    @if (count($tasks) === 0)
        <div class="alert alert-danger p-2">
            All Task Completed
            <br>
            <br>
            <a href="{{ route('task.create') }}" class="btn btn-info">
                <i class="fa fa-plus-circle"></i> Create Task
             </a>
        </div>
    @endif

@endsection
