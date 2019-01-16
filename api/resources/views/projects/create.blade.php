<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projects Create</title>
    
    <style> 
        .is-danger{
            border-color: red;
            color: black;
        }
    </style>
</head>
<body>
    <h1>Create a new project</h1>
    <form method="POST" action="/projects">
        {{ csrf_field() }}

        <div class="field">
            <label for="title" class="label">Project Title</label>
        
            <div class="control">
                <input 
                    type="text" 
                    name="title"
                    class="input {{ $errors->has('title') ? 'is-danger' : '' }}" 
                    value="{{ old('title') }}"
                    required
                >
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Project Description</label>
            <div class="control">
                <textarea 
                    name="description" 
                    placeholder="Project Description" 
                    cols="30" rows="10" 
                    class="input {{ $errors->has('description') ? 'is-danger' : '' }}" 
                    required
                >
                    {{ old('description') }}
                </textarea>
            </div>
        </div>

        <div class="field">  
            <button type="submit">Create Project</button>
        </div>
    </form>

    @include('errors')
</body>
</html>