$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
          for (i = 0; i < input.files.length; i++) {
              $('#js-' + $(input).attr('name') + '-wrapper').html('');
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#js-' + $(input).attr('name') + '-wrapper').append(
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

        return '<div class="form-row js-remove" data-id="'+id+'">' 
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

            if(ids.indexOf(id) != -1)
            {
                if(add)
                {
                    ids.push(id);
                    $('input#js-ids').val(JSON.stringify(ids));
                }
            }
            else
            {
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
})

