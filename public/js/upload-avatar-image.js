

function isCurrent_passsword(){
    var formData = new FormData();    
    formData.append('old_password', $('[name="current_password"]').val() );            

    $.ajax({
      url: '../youraccount/check_password_ajax', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        console.log( 'Return Data:......  ', data);
        if( data == 1 ) {
          $( '[name="password"]' ).focus();
        } else {
          $('[name="current_password"]').val();
          $('#enableForm')
              .bootstrapValidator('updateStatus', 'current_password', 'NOT_VALIDATED')
              .bootstrapValidator('validateField', 'current_password')
              .bootstrapValidator('updateStatus','current_password', 'INVALID', 'callback');                    
        }
      }
    })
};

/*----- jquery -----*/
$(document).ready(function (e) {

  function noPreview(){
    let user_avatar = document.getElementById('user_avatar').value;
    $( 'input[type="file"]').val('');
    $( '#pre_upload' ).css("display", "block");    
    $( '#previewImg').attr('src', '../upload/'+user_avatar );
    $( '#confirm_upload').css("display", "none"); 
  }

  $("#change_password").click(function (e) {
      $( '#new_password' ).css("display", "block");
      $( '#profile_div' ).css('display', 'none');      
  });  

  $("#cancelImg").click(function (e) {
      noPreview();
  });  

  function selectImage(e) {
    $( '#previewImg').attr('src', e.target.result).css("height","150").css("width","200");
    $( '#confirm_upload' ).css("display", "block");
    $( '#pre_upload' ).css("display", "none");        
  }

  var maxsize = 1024 * 1024; // 500 KB
  $('#max-size').html((maxsize/1024).toFixed(2));

  /* On submit */
  $('#upload-image-form').on('submit', function(e) {
    $( '#upload-button').prop("disabled",true);
    $( '#cancelImg').prop("disabled",true);

    e.preventDefault();
    let target_url = '../users_upload/ajax_upload_one'; 
    var formData = new FormData(this);
    upload_ajax( target_url, formData );

  });

  $('#remove_avatar').on('click', function( ) {
    // confirm model
    $("div .modal-body").html('Avatar will be replaced with a default image.<br>Continue?');                    
    $("div .modal-header").addClass("modal-header-warning");                
    $('#success').modal('show');    
    // $('div .modal-footer #close').modal('toggle').on('click', function(){
    //     $('#modal').modal('hide');
    // });

    $('div .modal-footer #yes').modal('toggle').on('click', function(){
        $('#modal').modal('data-dismiss');
        let target_url = '../users_upload/ajax_remove_avatar'; 
        upload_ajax( target_url, null );
    });

  });


  function upload_ajax(target_url, formData)
  {
    // formData.append('id', _(obj.id).value );            

    $.ajax({
      url: target_url, 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        var imgData = JSON.parse( data );
         console.log( 'Return Data:......  ', imgData, imgData['file_name'] );        

        document.getElementById('user_avatar').value = imgData['file_name'];
        $( '#upload-button').prop("disabled",false);
        $( '#cancelImg').prop("disabled",false);
        $( '#confirm_upload').css("display", "none"); 
        $( '#pre_upload').css("display", "block");         

        if( imgData['file_name'] == 'annon_user.png' ) noPreview();

      }

    });

  }


  /* On change */
  $('input[type="file"]').change(function() {
    /* assign to value to img obj */
    var img_id = this.id;    
    $('#message').empty();

    /* check for file attributes */
    var file = this.files[0];
    var match = ["image/jpeg", "image/png", "image/jpg"];

    if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
    {
      noPreview();
      $('#message').html('<div class="alert alert-warning error_messages" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');
      return false;
    }

    if ( file.size > maxsize )
    {
      noPreview();
      $('#message').html('<div class=\"alert alert-danger error_messages\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');
      return false;
    }

    /* preview selected image */ 
    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);

  });



  /* ----- Change password ------ */
    $('[name="cancel"]').on('click', function(){
      window.location.replace('../youraccount/welcome');            
    })

    $('#enableForm')
        .bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                current_password: {
                    validators: {
                        notEmpty: {
                            message: 'The current password is required and cannot be empty'
                        },
                        callback: {
                            message: "The current password not valid"
                        }
                    }
                },
                password: {
                    enabled: false,
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Password requires at least 6 charters'
                        },                      
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        identical: {
                            field: 'confirm_password',
                            message: 'The password and its confirm must be the same'
                        }
                    }
                },
                confirm_password: {
                    enabled: false,
                    validators: {
                        notEmpty: {
                            message: 'The confirm password is required and cannot be empty'
                        },
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm must be the same'
                        }
                    }
                }
            }
        })
        // Enable the password/confirm password validators if the password is not empty
        .on('keyup', '[name="password"]', function() {
            var isEmpty = $(this).val() == '';
            $('#enableForm')
                    .bootstrapValidator('enableFieldValidators', 'password', !isEmpty)
                    .bootstrapValidator('enableFieldValidators', 'confirm_password', !isEmpty);

            // Revalidate the field when user start typing in the password field
            if ($(this).val().length == 1) {
                $('#enableForm').bootstrapValidator('validateField', 'password')
                                .bootstrapValidator('validateField', 'confirm_password');
            }
        })
        .on('keydown', '[name="current_password"]', function(e) {
            var keyCode = e.keyCode || e.which;
            // console.log( 'keyCode',keyCode);
            if ( (keyCode === 13) || (keyCode == 9) ) { 
                e.preventDefault();
                isCurrent_passsword();    
            }
        });

}); // jquery end