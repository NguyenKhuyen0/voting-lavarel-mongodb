<!-- voting index.blade.php -->
<?php
use App\question;
?>
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
        <th>voting</th>
        <th>questions</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($votings as $voting)
      <tr>
        <td>{{$voting->id}}</td>
        <td>{{$voting->title}}</td>
        <?php
          // var_dump(new question());
            $questions =  Question::where('voting_id', 'LIKE', $voting->id.'%')->get();
            

   
            // die();
        ?>
        <td>

        @foreach($questions as $question)
          - {{$question->question}}<br>
        @endforeach
        </td>
        <td><a href="{{action('VotingController@edit', $voting->id)}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('VotingController@destroy', $voting->id)}}" method="post">
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