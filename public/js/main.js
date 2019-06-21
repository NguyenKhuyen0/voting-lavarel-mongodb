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
})