@extends('admin_template')

@section('content')
<!-- optionedit.blade.php -->

<!-- <!DOCTYPE html>
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
  <body> -->
      <div class="contact-clean" style="width: 100%;">
      <form method="post" action="{{action('OptionController@update', $id)}}">
        @csrf
          <h2 class="text-center">EDIT Option</h2>
          <div class="form-group"><input type="text" name="title" placeholder="Title" class="form-control" value="{{$option->title}}" /></div>
          <div class="form-group"><textarea rows="14" name="content" placeholder="Content" class="form-control">{{$option->content}}</textarea></div>
          <div class="form-group"><label class="d-block" for="image" style="font-size: 18px;">Image option</label><input type="file" name="image" /></div>
          <div class="form-row" id="js-image-wrapper">
          @if ($option->image)
            <div class="col" id="js-file-wrapper"><img src="{{url('/images/'.$option->image)}}" width="100px" /></div>
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
              <div class="col js-file-wrapper" style="padding: 5px;"><img src="{{url('/images/'.$img)}}" width="100px"/></div> 
            @endforeach
            @endif
              
          </div>
          <div class="form-group" style="  margin-top: 20px;"><input type="text" name="votes" placeholder="Số lượt votes" class="form-control" value="{{$option->votes}}" /></div>
          <div class="form-group"><button class="btn btn-primary" type="submit">Lưu</button></div>
        </form>
      </div>
  <!-- </body>
</html> -->
@endsection