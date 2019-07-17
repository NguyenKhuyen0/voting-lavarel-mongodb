@extends('admin_template')

@section('content')
<!-- optioncreate.blade.php -->
<?php
use App\Question;
?>
<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel MongoDB CRUD Tutorial With Example</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">  
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
    <script src="{{asset('js/main.js')}}"></script>
  </head>
  <body> -->

    <div class="contact-clean" style="width: 100%;">
          <form method="post" action="{{action('VotingController@update', $id)}}" enctype="multipart/form-data">
              @csrf
            <h2 class="text-center">Edit Voting</h2>
            <div class="form-row" style="margin-bottom: 20px">
    
              <label for="search">Title</label>
              <input type="text" placeholder="Enter the question" name="title" class="form-control" value="{{$voting->title}}"/>
            </div>
            <div class="form-group"><textarea rows="14" name="description" placeholder="Description" class="form-control"  value="{{$voting->description}}">{{$voting->description}}</textarea></div>
            <div class="form-group"><label class="d-block" for="image" style="font-size: 18px;">Image</label><input type="file" name="image" /></div>
            <div class="form-row" id="js-image-wrapper">
                @if ($voting->image)
                <div class="col" id="js-file-wrapper"><img src="{{url('/images/'.$voting->image)}}" width="100px" /></div>
                @endif
            </div>
      
            <div class="form-row" style="margin-bottom: 20px">
              <label>Search Question</label>
              <input type="search" placeholder="Search questions" class="form-control" id="js-search" />
            </div>
            
            <div id="js-search-input">
            </div>
  
            <h3 id="js-options-id" class="mgb-20px">Questions:</h3>
            <div id="js-options-input">
                <?php
                    $questions =  Question::where('voting_id', 'LIKE', $voting->id.'%')->get();
                    $ids = [];
                ?>
                @foreach($questions as $question)
                <?php $ids []= $question->id; ?>
                <div class="form-row js-remove mgb-20px"  data-id="{{$question->id}}">
                  <div class="col" style="box-shadow: 1px 1px 1px rgba(0,0,0,0.05);border: 1px solid #ced4da;">{{$question->question}}</div>
                  <div class="col col-auto"><button class="btn btn-danger active btn-danger remove" type="button">Remove</button></div>
                </div>
                @endforeach
            </div>
            
            <input type="hidden" name="ids" id="js-ids" value="{{json_encode($ids)}}" />      
            <?php $checked = ''; $checked =  $voting->active ? 'checked' : '';  ?>
            <div class="form-group" style="  margin-top: 20px;"><input type="checkbox" name="active" {{$checked}} >  Active</div>            
            <div class="form-group" style="  margin-top: 20px;"><input type="datetime-local" name="start_time" value="{{$voting->start_time}}">  Thời gian bắt đầu</div>
            <div class="form-group" style="  margin-top: 20px;"><input type="datetime-local" name="end_time" value="{{$voting->end_time}}">  Thời gian kết thúc</div>
            <div class="form-group"><button class="btn btn-primary" type="submit">Lưu</button></div>
        </form>
    </div>
<!-- </body>  -->

<script type="text/javascript">
            // jQuery wait till the page is fullt loaded
            $(document).ready(function () {
                // keyup function looks at the keys typed on the search box
                $('#js-search').on('keyup',function() {
                    console.log($(this).val());
                    // the text typed in the input field is assigned to a variable 
                    var query = $(this).val();
                    // call to an ajax function
                    $.ajax({
                        // assign a controller function to perform search action - route name is search
                        url:"{{ url('voting/search') }}",
                        // since we are getting data methos is assigned as GET
                        type:"GET",
                        // data are sent the server
                        data:{'title':query},
                        // if search is succcessfully done, this callback function is called
                        success:function (data) {
                            // print the search results in the div called country_list(id)
                            $('#js-search-input').html(data);
                        }
                    })
                    // end of ajax call
                });

       
            });
        </script>
 
<!-- </html> -->
@endsection
