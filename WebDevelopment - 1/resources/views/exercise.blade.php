@extends('base')

@section('custom_head')
    <style>
        .question-list {
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <div class="content">
    <h2>{{ $subject->name }}<h2>
    <h5>{{ $subject->description }}</h5>

    <div class="question-list">
        <?php $counter=1 ?>
        <form action="{{ url('/getscore') }}" method="post">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}" />
            @foreach ($questions as $question)
                <hr>
                <p>{{ $counter }}. {{ $question->question}}<p>
                <input type="radio" name="ans{{ $counter }}" value="0" checked="checked" style="display:none">
                <input type="radio" name="ans{{ $counter }}" value="1" id="{{$counter}}-1">
                <label for="{{$counter}}-1">{{ $question->option_one }}</label><br>
                <input type="radio" name="ans{{ $counter }}" value="2" id="{{$counter}}-2">
                <label for="{{$counter}}-2">{{ $question->option_two }}</label><br>
                <input type="radio" name="ans{{ $counter }}" value="3" id="{{$counter}}-3">
                <label for="{{$counter}}-3">{{ $question->option_three }}</label><br>
                <input type="radio" name="ans{{ $counter }}" value="4" id="{{$counter}}-4">
                <label for="{{$counter}}-4">{{ $question->option_four }}</label><br>
                <input type="radio" name="ans{{ $counter }}" value="5" id="{{$counter}}-5">
                <label for="{{$counter}}-5">{{ $question->option_five }}</label><br>
                <?php $counter++ ?>
            @endforeach
            <br><br>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
    </div>
@endsection