<!-- optionedit.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel MongoDB CRUD Tutorial With Example</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  
  </head>
  <body>
    <div class="container">
      <h2>Edit A Form</h2><br/>
      <div class="container">
    </div>
      <form method="post" action="{{action('OptionController@update', $id)}}">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">

          </div>
        </div>
        <div class="row">
          <div class="col-md-4" id="image-wrapper">
          <img src="{{url('/images/'.$option->image)}}" width="100px" id="image">
          <a href="javascript:void(0)" id="image-control" onclick="removeImageInput('image')">Xóa ảnh</a>
          </div>
          <div class="form-group col-md-4">
            <label for="image">Option Image:</label>
            <input type="file" class="form-control" name="image">
            <input type="file" class="form-control" name="image">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4" id="extra_images-wrapper">

          </div>
          <div class="form-group col-md-4">
            <label for="extra_images">Option Extra Images:</label>
            <input type="file" class="form-control" multiple="multiple" name="extra_images">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="content">Option Content:</label>
            <input type="text" class="form-control" name="content" value="{{$option->content}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="votes">Option Votes:</label>
            <input type="text" class="form-control" name="votes " value="{{json_encode($option->image)}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
   </div>
  </body>
  <script>
  function removeImageInput(name)
  {
      document.getElementById(name).remove();
      document.getElementById(name + '-control').remove();
  }
  </script>
</html>