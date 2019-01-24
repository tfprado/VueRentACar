@extends('projects.layout')

@section('content')
    <div class="container">

        <h1 class="title">{{ $project->title }}</h1>

        <div class="content">{{ $project->description }}</div>

        <p>
            <a href="/projects/{{ $project->id }}/edit">Edit</a>
        </p>

        @if ($project->tasks->count())
            <div class="box">
                @foreach ($project->tasks as $task)
                    <div>
                        <form method="POST" action="/completed-tasks/{{ $task->id }}">
                            @csrf

                            @if ($task->completed)
                                @method('DELETE')
                            @endif

                            <label for="completed" class="checkbox {{ $task->completed ? 'is-complete' : ''}}">
                                <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                                {{ $task->description }}
                            </label>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif


        {{-- Add a new task form --}}
        <form class="box" method="POST" action="/projects/{{ $project->id }}/tasks">
            @csrf
            <div class="field">
                <label for="description" class="label">New Task</label>

                <div class="control">
                    <input type="text" class="input" name="description" placeholder="New Task" required>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button">Add Task</button>
                </div>
            </div>

            @include('errors')
        </form>
    </div>
@endsection
