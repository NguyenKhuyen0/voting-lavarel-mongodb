$(document).ready(function () {
    function readURL(input) {
        if (input.files && input.files[0]) {
            for (i = 0; i < input.files.length; i++) {
                console.log($(input).attr('name').replace('[]', ''));
                $('#js-' + $(input).attr('name').replace('[]', '') + '-wrapper').html('');
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#js-' + $(input).attr('name').replace('[]', '') + '-wrapper').append(
                        '<div class="col" id="js-file-wrapper"><img src="' + e.target.result + '" style' +
                        '="width: 100px" /></div>'
                    );
                }
                reader.readAsDataURL(input.files[i]);
            }

        }
    }

    $("input[type='file']").change(function () {
        readURL(this);
    });

    // Question

    $("body").on("click", ".js-add button", function () {
        var input = $(this)
            .parents(".js-add")
            .find('.js-input');
        var title = input.html();
        var id = input.attr('data-id');
        console.log(id);
        $('#js-options-input').append(createOptionInput(title, id));
        $('#js-options-id').removeClass('d-none');
        updateInputIDs(id, true);

    });

    $("body").on("click", ".remove", function () {
        var e = $(this).parents(".js-remove");
        var id = e.attr('data-id');
        updateInputIDs(id, false);
        e.remove();

    });

    function createOptionInput(title, id) {

        return '<div class="form-row js-remove mgb-20px"  data-id="' + id + '"><div cla' +
                'ss="col" style="box-shadow: 1px 1px 1px rgba(0,0,0,0.05);border: 1px solid #ce' +
                'd4da;">' + title + '</div><div class="col col-auto"><button class="btn btn-dan' +
                'ger active btn-danger remove" type="button">Remove</button></div></div>';
    }
    function updateInputIDs(id, add) {
        var ids = $('input#js-ids').val();
        console.log(ids);
        if (ids) {

            ids = JSON.parse(ids);

            if (ids.indexOf(id) == -1) {
                console.log('here');
                if (add) {
                    ids.push(id);
                    console.log(ids);
                    console.log('here2');
                    $('input#js-ids').val(JSON.stringify(ids));
                }
            } else {
                console.log('here1');

                if (!add) {
                    var index = ids.indexOf(id);
                    ids.splice(index, 1);
                    $('input#js-ids').val(JSON.stringify(ids));
                }

            }

        } else {
            $('input#js-ids').val(JSON.stringify([id]));
        }
        console.log(ids + $('input#js-ids').val());

    }


    
   
    $("#add-option-form").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function (data) {
                if (data == 'invalid') {
                    // invalid file format.
                    $("#err")
                        .html("Invalid File !")
                        .fadeIn();
                } else {
                    // view uploaded file.
                    // $("#preview")
                    //     .html(data)
                    //     .fadeIn();
                    // reset form Create Option
                    $(" #add-option-form")[0].reset();
                    $('#add-option-form #js-image-wrapper').html('');
                    $('#add-option-form #js-gallery-wrapper').html('');
                    if(data)
                    {

                        var option = JSON.parse(data);
                        // Update input option id
                        if(option && option._id)
                        {                            
                            updateInputIDs(option._id, true);
        
                            //Add row to  Options table
                            if( $('#js-options-form-wrapper').hasClass('d-none'))
                            {
                                $('#js-options-form-wrapper').removeClass('d-none');
                            }
                            $('#js-options-form-wrapper table tbody').append(creatOptionRow(option));
                        }
                    }
                }
            },
            error: function (e) {
                $("#err")
                    .html(e)
                    .fadeIn();
            }
        });
    }));
    $("body").on("click", ".js-delete-option",function(e){
        var id = $(this).attr('data-id');
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                //$("#preview").fadeOut();
                // $("#err").fadeOut();
            },
            success: function (data) {
                console.log($('form[data-id="'+id+'"]').parent());
                
                $('form[data-id="'+id+'"]').parent().parent().remove();
            },
            error: function (e) {
                // $("#err")
                //     .html(e)
                //     .fadeIn();
            }
        });
    })
    function creatOptionRow(option)
    {
        var gallery = option.gallery;
        var  imgs_string = '';
        gallery.forEach(img => {
            imgs_string += '<img src="/images/'+img+'" width="50px">';
        });
        var template = '<tr>'+
        '            <td>'+option.title+'</td>'+
        '            <td>'+option.content+'</td>'+
        '            <td>'+
        '                <img src="/images/'+ option.image+'" width="50px"></td>'+
        '            <td>'+imgs_string+'</td>'+
        '            <td>'+ option.votes +'</td>'+
        '            <td>'+
        '                <a href="/option/edit/'+option._id+'" class="btn btn-warning">Edit</a>'+
        '            </td>'+
        '            <td>'+
        '                <form action="/api/v1/option/'+option._id+'" method="POST" class="js-delete-option" data-id="'+option._id+'">'+
        '                    <input name="_method" type="hidden" value="DELETE">'+
        '                    <button class="btn btn-danger" type="submit">Delete</button>'+
        '                </form>'+
        '            </td>'+
        '        </tr>';

        return template;
            
    }


    $('button[type="submit"][for="add_question_form"]').click(function(e){
        $('#add_question_form').submit();
    })




})
