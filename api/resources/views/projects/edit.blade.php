@extends('projects.layout')

@section('content')
    <div class="container">

        <h1 class="text-center">Edit Project</h1>

        <form method="POST" action="/projects/{{ $project->id }}">
            @method('PATCH')
            @csrf

            <div class="field">
                <label class="label" for="title">Title</label>
                <div class="control">
                    <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title }}">
                </div>
            </div>

            <div class="field">
                <label for="description" class="description">Description</label>
                <div class="control">
                    <textarea name="description" cols="30" rows="10" class="textarea">{{ $project->description }}</textarea>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link">Update Project</button>
                </div>
            </div>
        </form>

        @include('errors')

        <form action="/projects/{{ $project->id }}" method="POST">
            @method('DELETE')
            @csrf

            <div class="field">
                <div class="control">
                    <button type="submit" class="button">Delete Project</button>
                </div>
            </div>
        </form>

    </div>
@endsection
