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



<!-- optioncreate.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel MongoDB CRUD Tutorial With Example</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>  
    <script src="{{asset('js/main.js')}}"></script>
  </head>
  <body>
      <div class="contact-clean" style="width: 100%;">
        <form method="post" action="{{action('OptionController@update', $id)}}">
          @csrf
          <h2 class="text-center">Create Option</h2>
          <div class="form-group"><input type="text" name="title" placeholder="Title" class="form-control" /></div>
          <div class="form-group"><textarea rows="14" name="content" placeholder="Content" class="form-control"></textarea></div>
          <div class="form-group"><label class="d-block" for="image" style="font-size: 18px;">Image option</label><input type="file" name="image" /></div>
          <div class="form-row" id="js-image-wrapper">
          @if ($option->image)
            <div class="col" id="js-file-wrapper"><img src="{{url('/images/'.$option->image)}}" /></div>
          @endif
          </div>
          <div class="form-group"><label class="d-block" for="gallery" style="margin-top: 20px;font-size: 18px;">Gallery</label><input type="file" name="gallery" multiple /></div>
          <div class="form-row" id="js-gallery-wrapper">
              <!-- <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
              <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
              <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
              <div class="col js-file-wrapper" style="padding: 5px;"><img src="https://via.placeholder.com/100" /></div>
              -->
            @if ($option->gallery)
            @foreach ($option->gallery as $img)
              <div class="col js-file-wrapper" style="padding: 5px;"><img src="{{url('/images/'.$img)}}" /></div> 
            @endforeach
            @endif
              
          </div>
          <div class="form-group" style="  margin-top: 20px;"><input type="text" name="votes" placeholder="Số lượt votes" class="form-control" /></div>
          <div class="form-group"><button class="btn btn-primary" type="submit">Lưu</button></div>
        </form>
      </div>
  </body>
</html>