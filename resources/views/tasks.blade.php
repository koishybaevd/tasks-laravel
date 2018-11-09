@extends('app')

@section('content')

<div class="container my-3">
    <div class="column d-flex justify-content-center">        
        <div class="col-12 col-md-8">

            <!-- Add Task -->
            <form action="/tasks" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="text" type="text" class="form-control" placeholder="Enter task" aria-label="task" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Add Task</button>
                    </div>
                </div>
            </form>

            <!-- Errors -->
            @include('errors')   

            <!-- Tasks -->
            <div class="card my-3">
                <div class="card-header">
                    Current Tasks
                </div>
                <div class="card-body py-2">
                    <ul class="list-group list-group-flush">
                        @foreach($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="{{ $task->completed ? 'text-muted' : '' }}">{{ $task->text }}</span>
                            <div>                                
                                <form action="/tasks/{{ $task->id }}/toggle" method="post" class="d-inline">
                                    @csrf
                                    @if(!$task->completed)
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @endif
                                </form>                                
                                <form action="/tasks/{{ $task->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                        @if (count($tasks) <= 0)
                            <p>No Tasks</p>
                        @endif
                    </ul>

                    <!-- Pagination and bottom buttons -->
                    <div class="row d-md-flex justify-content-between">
                        <div class="mt-3">
                            {{ $tasks->links() }}
                        </div>

                        <div class="m-3">
                            <form action="/tasks/complete" method="post" class="d-inline">
                                @csrf
                                <button class="d-inline btn btn-outline-success">Complete All</button>
                            </form>
                            <form action="/tasks/clear" method="post" class="d-inline">
                                @csrf
                                <button class="d-inline btn btn-outline-secondary">Clear Completed</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            

        </div>
    </div>
</div>

@endsection