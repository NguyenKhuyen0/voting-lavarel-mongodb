<!-- Option index.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
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
        <td>{{$option->id}}</td>
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
  </body>
</html>