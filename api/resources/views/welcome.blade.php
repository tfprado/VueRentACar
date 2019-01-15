@extends('layout')

@section('title')
    Home
@endsection

@section('content')
    <h1>Home {{ $foo }}</h1>

    <!-- php way to add tasks -->
    <!-- <ul>
        <?php foreach ($tasks as $task) : ?>
            <li><?= $task; ?></li>
        <?php endforeach; ?>
    </ul> -->

    <ul>
        @foreach($tasks as $task)
        <li>{{ $task }}</li>
        @endforeach
    </ul>
@endsection