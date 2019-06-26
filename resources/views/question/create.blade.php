<!-- optioncreate.blade.php -->

<!DOCTYPE html>
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
  <body>
    <div class="contact-clean" style="width: 100%;">
          <form method="post" action="{{url('question/add')}}" enctype="multipart/form-data">
              @csrf
            <h2 class="text-center">Create Question</h2>
            <div class="form-row" style="margin-bottom: 20px">
              <label for="search">Question</label>
              <input type="text" placeholder="Enter the question" name="question" class="form-control"/>
            </div>
            
            <div class="form-row" style="margin-bottom: 20px">
              <label>Search Options</label>
              <input type="search" placeholder="Search options" class="form-control" id="js-search" />
            </div>
            
            <div id="js-search-input">
     
            </div>
            <h3 class="d-none mgb-20px" id="js-options-id">Options:</h3>
            <div id="js-options-input">
           
            </div>
            <input type="hidden" name="ids" id="js-ids" />            
            <div class="form-group"><button class="btn btn-primary" type="submit">Lưu</button></div>
        </form>
    </div>
</body> 

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
 
</html>