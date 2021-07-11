@extends('base')

@section('custom_head')
    <script>
        var subject_id = "<?php echo $subject->id; ?>";
        subject_id = parseInt(subject_id)

        function addQuestion() {
            $.ajax({
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", "subject_id": subject_id},
                url: "/createBlankQuestion/",
                success: function(result) {
                    document.getElementById("no_question").innerHTML = "";
                    document.getElementById("question-list").innerHTML += "\
                        <div id=" + result + ">\
                            <hr> \
                            <h4>Id: " + result + "</h4>\
                            <h3>Question</h3>\
                            <p>Option 1: 1</p>\
                            <p>Option 2: 2</p>\
                            <p>Option 3: 3</p>\
                            <p>Option 4: 4</p>\
                            <p>Option 5: 5</p>\
                            <p>Answer: 1</p>\
                            <button onClick=\"updateQuestion(" + result + ")\" class=\"btn btn-primary\">Update</button>\
                            <button onClick=\"deleteQuestion(" + result + ")\" class=\"btn btn-danger\">Delete</button>\
                        </div>";
                }
            })
        };

        function deleteQuestion(question_id) {
            $.ajax({
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", "question_id": question_id},
                url: "/deleteQuestion/",
                success: function(result) {
                    var question_count = "<?php echo sizeof($questions); ?>";
                    if (question_count == 0) {
                        document.getElementById("no_question").innerHTML = '<h2 id="no_question">There is \
                            no Question yet! Create A Question first!</h2>';
                    }
                    document.getElementById(question_id).innerHTML = "";
                }
            })
        }

        function updateQuestion(question_id) {
            document.getElementById("question_id").innerHTML = question_id;
            $("#question_id_form").attr("value", question_id);
        };

        $(function () {
            $('#updateform').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/updateQuestion/',
                    data: $('form').serialize(),
                    success: function (result) {
                        var pointer = $('#' + result["question_id"]).children().first().next(); // parent to hr to id to question
                        
                        // Question
                        pointer = pointer.next()
                        if (typeof result["question"] != "undefined") {
                            pointer.text(result["question"]);
                        }

                        // Option 1
                        pointer = pointer.next()
                        if (typeof result["option_one"] != "undefined") {
                            pointer.text('Option 1: ' + result["option_one"]);
                        }

                        // Option 2
                        pointer = pointer.next()
                        if (typeof result["option_two"] != "undefined") {
                            pointer.text('Option 2: ' + result["option_two"]);
                        }

                        // Option 3
                        pointer = pointer.next()
                        if (typeof result["option_three"] != "undefined") {
                            pointer.text('Option 3: ' + result["option_three"]);
                        }

                        // Option 4
                        pointer = pointer.next()
                        if (typeof result["option_four"] != "undefined") {
                            pointer.text('Option 4: ' + result["option_four"]);
                        }

                        // Option 5
                        pointer = pointer.next()
                        if (typeof result["option_five"] != "undefined") {
                            pointer.text('Option 5: ' + result["option_five"]);
                        }

                        // Answer
                        pointer = pointer.next()
                        if (typeof result["answer"] != "undefined") {
                            pointer.text('Answer: ' + result["answer"]);
                        }
                    }
                });
            });
        });

        $( document ).ready(function() {
            var question_count = "<?php echo sizeof($questions); ?>";
            if (question_count == 0) {
                document.getElementById("no_question").innerHTML = '<h2 id="no_question">There is \
                    no Question yet! Create A Question first!</h2>';
            }
        });

    </script>

    <style>
        #question-list {
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <h2>{{ $subject->name }}<h2>
        <h5>{{ $subject->description }}</h5>

        <div id="question-list">
            <div id="no_question"></div>
            @foreach ($questions as $question)
                <div id="{{ $question->id }}">
                    <hr>
                    <h4>ID: {{ $question->id }}</h4>
                    <h3>{{ $question->question }}</h3>
                    <p>Option 1: {{ $question->option_one }}</p>
                    <p>Option 2: {{ $question->option_two }}</p>
                    <p>Option 3: {{ $question->option_three }}</p>
                    <p>Option 4: {{ $question->option_four }}</p>
                    <p>Option 5: {{ $question->option_five }}</p>
                    <p>Answer:  {{ $question->answer }}</p>
                    <button onClick="updateQuestion({{ $question->id }})" class="btn btn-primary">Update</button></a>
                    <button onClick="deleteQuestion({{ $question->id }})" class="btn btn-danger">Delete</button>
                </div>
            @endforeach
        </div>
        <hr>
        <button onclick="addQuestion()" class="btn btn-primary">Add Question</button>
        <hr>
        <div>
            <h1>Update Form</h1>
            <div style="margin-bottom: 200px;" id="formSection">
                <p>Updating Question With Id: <div id="question_id">0</div></p>
                <form id="updateform">
                    @csrf
                    <br><input id="question_id_form" type="hidden" name="question_id" value="0" />
                    <p>Question: <input type="text" name="question" /></p>
                    <p>Option 1: <input type="text" name="option_one" /></p>
                    <p>Option 2: <input type="text" name="option_two" /></p>
                    <p>Option 3: <input type="text" name="option_three" /></p>
                    <p>Option 4: <input type="text" name="option_four" /></p>
                    <p>Option 5: <input type="text" name="option_five" /></p>
                    <p>Answer: <input type="number" name="answer" /></p>
                    <input type="submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection