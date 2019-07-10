<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Untitled</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">  
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
</head>
<?php
    use App\question;
    use App\option;
    // echo json_encode($voting);

    $questions =  Question::where('voting_id', 'LIKE', $voting->id.'%')->get();
    // echo json_encode($questions);
    $title = $voting->title;
    // echo $title;

?>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{$title}}</h1>
            </div>
        </div>
        @foreach($questions as $question)
 
        <div class="row">
            <div class="col">
                <p>{{$question->question}}</p>
            </div>
        </div>
        <div class="row js-question" data-id="{{$question->id}}">
            <div class="col d-flex justify-content-between">
                <?php
                    $options=  Option::where('question_id', 'LIKE', $question->id.'%')->get();
                ?>
                @foreach($options as $option)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="{{ $option->id}}" />
                    <label class="form-check-label" for="formCheck-1">{{ $option->title}}</label>
                    <p>{{$option->votes}}</p>
                </div>
                @endforeach
                <div class="form-check">
                        <button class="btn btn-primary js-add-option">Thêm option</button>
                </div>


            </div>
        </div>
   
        @endforeach
        <div class="row">
            <div class="col">
                <button class="btn btn-primary" id="js-save-voting">gởi</button>
            </div>
        </div>
    </div>
</body>

</html>