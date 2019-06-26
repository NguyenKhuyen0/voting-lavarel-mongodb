@extends('admin_template')

@section('content')
<!-- optioncreate.blade.php -->

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
  <div class="row">
      <div class="col-md-4">
        <div style="width: 100%;">
          <form method="post" action="{{url('option/add')}}" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center">Create Option</h2>
            <div class="form-group"><input type="text" name="title" placeholder="Title" class="form-control" /></div>
            <div class="form-group"><textarea rows="14" name="content" placeholder="Content" class="form-control"></textarea></div>
            <div class="form-group"><label class="d-block" for="image" style="font-size: 18px;">Image option</label><input type="file" name="image" /></div>
            <div class="form-row" id="js-image-wrapper">
                <!-- <div class="col" id="js-file-wrapper"><img src="https://via.placeholder.com/100" /></div> -->
            </div>
            <div class="form-group"><label class="d-block" for="gallery" style="margin-top: 20px;font-size: 18px;">Gallery</label><input type="file" name="gallery[]" multiple /></div>
            <div class="form-row" id="js-gallery-wrapper">
                <!-- <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
                <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
                <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
                <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
                <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div> -->
            </div>
            <div class="form-group" style="  margin-top: 20px;"><input type="text" name="votes" placeholder="Số lượt votes" class="form-control" /></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">Add</button></div>
          </form>
        </div>
      </div>
      <div class="col-md-8">
        <div class="" style="width: 100%;">
          <form method="post" action="{{url('question/add')}}" enctype="multipart/form-data">
              @csrf
            <h2 class="text-center">Create Question</h2>
            <div class="form-row" style="margin-bottom: 20px">
              <input type="text" placeholder="Enter the question" name="question" class="form-control"/>
            </div>
            
            <h3 class="d-none mgb-20px" id="js-options-id">Options:</h3>
            <div id="js-options-input">
            <?php
              use App\Option;
              $options = Option::all();

            ?>
            <div class="">
              <br />
              @if (\Session::has('success'))
                <div class="alert alert-success">
                  <p>{{ \Session::get('success') }}</p>
                </div><br />
              @endif
              <table class="table table-striped">
              <thead>
                <tr>
              
                  <th>Title</th>
                  <th>Content</th>
                  <th>image</th>
                  <th>Galary</th>
                  <th colspan="2">votes</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach($options as $option)
                <tr>
                  <td>{{$option->title}}</td>
                  <td>{{$option->content}}</td>
                  <td><img src="{{url('/images/'.$option->image)}}" width="50px"></td>
                  <td>
                  @if ($option->gallery)
                  @foreach ($option->gallery as $img)
                  <img src="{{url('/images/'.$img)}}" width="50px">
                  @endforeach
                  @endif
                  
                  </td>

                  <td>{{$option->votes}}</td>
                  <td><a href="{{action('OptionController@edit', $option->id)}}" class="btn btn-warning">Edit</a></td>
                  <td>
                    <form action="{{action('OptionController@destroy', $option->id)}}" method="post">
                      @csrf
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>
            </div>
            </div>
            <input type="hidden" name="ids" id="js-ids" />            
            <div class="form-group"><button class="btn btn-primary" type="submit">Lưu</button></div>
          </form>
        </div>

      </div>
 
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
                        url:"{{ url('question/search') }}",
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