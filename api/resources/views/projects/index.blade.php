@extends('projects.layout')

@section('content')
    <div class="container">
        <h1>Projects</h1>

        <ul>
            @foreach ($projects as $project)
            <li>
                <a href="/projects/{{ $project->id }}">
                            {{ $project->title }}
                        </a>
            </li>
            @endforeach
        </ul>
    </div>
@endsection
