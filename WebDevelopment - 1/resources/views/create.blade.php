@extends('base')

@section('content')
    <div class="content">
        <form action="{{ url('/createsubject') }}" method="post">
            @csrf
            <div class="field-input">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" />
            </div>
            <div class="field-input">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" />
            </div>
            <input class="btn btn-primary" type="submit">
        </form>
    </div>
@endsection