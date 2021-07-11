@extends('base')

@section('content')
    <div class="subjects">
        @foreach ($subjects as $subject)
            <h1>{{ $subject->name}}</h1>
            <p>{{ $subject->description }}</p>
            <a href="edit/{{ $subject->id }}""><button class="btn btn-secondary">Edit</button></a>
            <a href="exercise/{{ $subject->id }}"><button class="btn btn-primary">Exercise</button></a><hr>
        @endforeach
    </div>
    <a href="/createsubject/"><button class="btn btn-dark">Add Subject</button></a>
@endsection