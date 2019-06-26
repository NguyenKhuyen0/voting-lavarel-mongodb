$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
          for (i = 0; i < input.files.length; i++) {
              console.log($(input).attr('name').replace('[]',''));
              $('#js-' + $(input).attr('name').replace('[]','') + '-wrapper').html('');
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#js-' + $(input).attr('name').replace('[]','') + '-wrapper').append(
                    '<div class="col" id="js-file-wrapper"><img src="'+e.target.result+'" style="width: 100px" /></div>');
              }
              reader.readAsDataURL(input.files[i]);
           }
      
        }
    }
      
    $("input[type='file']").change(function() {
        readURL(this);
    });


    // Question

    $("body").on("click",".js-add button",function(){ 
        var input = $(this).parents(".js-add").find('.js-input');
        var title = input.html();
        var id = input.attr('data-id');
        console.log(id);
        $('#js-options-input').append(createOptionInput(title, id));
        $('#js-options-id').removeClass('d-none');
        updateInputIDs(id, true);
        
    });



    $("body").on("click",".remove",function(){
        var e = $(this).parents(".js-remove");
        var id = e.attr('data-id');
        updateInputIDs(id, false); 
        e.remove();
        
    });

    function createOptionInput(title, id)
    {

        return '<div class="form-row js-remove mgb-20px"  data-id="'+id+'">' 
            + '<div class="col" style="box-shadow: 1px 1px 1px rgba(0,0,0,0.05);border: 1px solid #ced4da;">'+title+'</div>' 
            + '<div class="col col-auto"><button class="btn btn-danger active btn-danger remove" type="button">Remove</button></div>'
        + '</div>';
    }
    function updateInputIDs(id, add)
    {
        var ids = $('input#js-ids').val();
        console.log(ids);
        if(ids)
        {


            ids =  JSON.parse(ids);

            if(ids.indexOf(id) == -1)
            {
                console.log('here');
                if(add)
                {
                    ids.push(id);
                    console.log(ids);
                    console.log('here2');
                    $('input#js-ids').val(JSON.stringify(ids));
                }
            }
            else
            {
                console.log('here1');

                if(!add)
                {
                    var index= ids.indexOf(id);
                    ids.splice(index, 1);
                    $('input#js-ids').val(JSON.stringify(ids));
                }

            }
    
        }
        else
        {
            $('input#js-ids').val(JSON.stringify([id]));
        }
        console.log(ids + $('input#js-ids').val());

    }

    $("body").on("click","#js-add-option",function(){
    
        // createRowOption()
    })
    function ajaxCreateOption()
    {
        var option {'title':query}
        $.ajax({
            // assign a controller function to perform search action - route name is search
            url:"{{ url('question/search') }}",
            // since we are getting data methos is assigned as GET
            type:"GET",
            // data are sent the server
            data: option,
            // if search is succcessfully done, this callback function is called
            success:function (data) {
                // print the search results in the div called country_list(id)
                $('#js-search-input').html(data);

            }
        })
    }

    $("#form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
               url: "question/add",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
               cache: false,
         processData:false,
         beforeSend : function()
         {
          //$("#preview").fadeOut();
          $("#err").fadeOut();
         },
         success: function(data)
            {
          if(data=='invalid')
          {
           // invalid file format.
           $("#err").html("Invalid File !").fadeIn();
          }
          else
          {
           // view uploaded file.
           $("#preview").html(data).fadeIn();
           $("#form")[0].reset(); 
          }
            },
           error: function(e) 
            {
          $("#err").html(e).fadeIn();
            }          
          });
       }));
})


function createRowOption()
{
    return  '<tr>' +    
                '<td>Ca sĩ sơn tùng</td>' +
                '<td>Ca sĩ sơn tùng</td>' +
                '<td><img src="/images/'+$("input[name='image']").prop("files")[0].name+'" width="50px"></td>' +
                ' <td>' +
                    '<img src="/images/58444198_2263823213696870_2016977145405898752_n.png" width="50px">' +
                    '<img src="/images/app.ico" width="50px">'  +        
                '</td>' +

                '<td>111</td>' +
                '<td><a href="/option/edit/5d12e2ed8f04e72640004b18" class="btn btn-warning">Edit</a></td>' +
                '<td>' +
                ' <button class="btn btn-danger" type="submit">Delete</button>' +
                '</td>' +
            '</tr>' ;
}