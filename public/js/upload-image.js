/*jslint browser: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true*/
/*global $, console, alert, FormData, FileReader*/

/* global img obj variables */
var img ={};
var output = {};
var client_files = [];
// var convert_arr = [];
var dupe_found = [];


function _(el){
  return document.getElementById(el);
}

function assign_id( id ){
    $('.error_messages').empty().css("display", "none");
    img['id'] = id.split('_').pop();
    return  img['id'];   
}

function noPreview(){
  $( '#previewImg_'+img['id']).attr('src', "../public/images/120x90.png" );
  $( '#pre_upload_'+img['id'] ).css("display", "block");
  $( '#confirm_upload_'+img['id'] ).css("display", "none"); 
  $( '#completed_upload_'+img['id'] ).css("display", "none");
  $( '#imageFile_'+img['id']).val('');  
  $( '#removeImg_'+img['id']).val(0);  
}

function selectImage(e) {
  // console.log('|'+'#previewImg_'+img['id'], '#pre_upload_'+img['id']);
  $( '#previewImg_'+img['id'] ).attr('src', e.target.result);
  $( '#pre_upload_'+img['id'] ).css("display", "none");
  $( '#confirm_upload_'+img['id'] ).css("display", "block");
}

/* ------- Dedupe functions -------*/ 
function dedupe(){
    // from client 
    var file = imgFileInfo( 'imageFile_'+img["id"] );  

    var a = client_files.indexOf(file);  
    if( a == -1 ){
      client_files.push(file);
    } else {
      $("div #model-header-title").html('Alert');                    
      $("div .modal-body").html(file+' has already been selected.<br>Please enter a different image. ');                          
      $("div .modal-header").addClass("modal-header-warning"); 
      $('#success').modal('show');
      return false;
    } 
}

function cancel( obj ){
  if( obj != undefined )
      assign_id(obj.id);

  // from client
  var file = imgFileInfo( 'imageFile_'+img["id"] );
  client_files_remove(file);
  noPreview();
}

function client_files_remove(fileName){
  //console.log('remove: ',fileName+'...', client_files);

  var index = client_files.indexOf(fileName);
  if (index > -1) {
      client_files.splice(index, 1);
  }
  // console.log('Done.... ', client_files);  
}

function remove( obj ){
    var position = assign_id( obj.id ); 
    var formData = new FormData(this);
    $( '#removeImg_'+position ).prop("disabled",true);

    formData.append('position', position);        
    formData.append('id', _(obj.id).value );            

    $.ajax({
      url: 'users_upload/ajax_remove', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
      //  console.log( 'Return Data:......  ', data);
        $( '#removeImg_'+position ).prop("disabled",false);      
        var imgData = JSON.parse( data );
        client_files_remove(imgData["remove_name"]);
       // console.log( 'Return Data:......  ', imgData);
        $('#message_'+output['position']).empty();

        if( output['error_mess'] == ''){
            $('#message_'+imgData['position']).empty();
            $('#message_'+imgData['position']).html('<div class=\"alert alert-info error_messages\" role=\"alert\"> '+imgData["remove_name"]+'<br>has been removed.</div>');
        } else {
            $('#message_'+output['position']).html('<div class=\"alert alert-danger error_messages\" role=\"alert\"> '+output["error_mess"]+'</div>');                            
        }              
        noPreview();
      }
    })  
}


function imgFileInfo( imageId ) {
    var file = _(imageId).files[0];
    // console.log(file.name+" | "+file.size+" | "+file.type );    
    return file.name;
}


/*----- jquery -----*/
$(document).ready(function (e) {
  // from server
  var server_img = $.parseJSON( $('#dbf_images').val() );
  for ( var key in server_img )
        client_files.push(server_img);


  var maxsize = 1024 * 1024; // 500 KB
    /* Save and exit */
  $(".cancel").click(function (e) {
        window.location.replace('../youraccount/welcome');            
  });  

  // $('#max-size').html((maxsize/1024).toFixed(2));

  /* On submit */
  $('#upload-image-form').on('submit', function(e) {
    $( '#upload-button_'+img['id'] ).prop("disabled",true); // img['id'] = position 
    $( '#cancelImg_'+img['id'] ).prop("disabled",true); // img['id'] = position 

    e.preventDefault();

    $('#message_'+img['id']).empty();
    var target = $('#upload_target').val();

    $.ajax({
      url: 'users_upload/ajax_upload', 
      method:"POST",
      data:new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        // console.log( 'Return Data:......  ', data);
        $( '#upload-button_'+img['id'] ).prop("disabled", false);        
        $( '#cancelImg_'+img['id'] ).prop("disabled", false);
        var imgData = JSON.parse( data );
        console.log( 'Return Data:......  ', imgData);

        for ( var key in imgData ) {        
            for ( prop in imgData[key] ){            
                output[prop] = imgData[key][prop];
                $('#message_'+output['position']).empty();

                if( output['error_mess'] == ''){
                    $('#removeImg_'+output['position'] ).val(output['update_id']); // new remove id number
                    $('#message_'+output['position']).html('<div class=\"alert alert-success error_messages\" role=\"alert\"> '+output["file_name"]+'<br>has successfuly uploaded.</div>');
                    $('#confirm_upload_'+output['position']).css("display", "none");                
                    $('#completed_upload_'+output['position']).css("display", "block");
                }else{
                    $('#message_'+output['position']).html('<div class=\"alert alert-danger error_messages\" role=\"alert\"> '+output["error_mess"]+'</div>');                  
                }
            }
        } 
      }
    });

  });

  /* On change */
  $('input[type="file"]').change(function() {
    /* assign to value to img obj */
    var img_id = this.id;    
    assign_id(img_id);

    $('#message_'+img['id']).empty();

    /* check for dupes here */
    var proceed = dedupe();
    if( proceed == false )
    {
      console.log('Abort. Duplicate records found............ ');
      noPreview();    
      return false;
    }

    /* check for file attributes */
    var file = this.files[0];
    var match = ["image/jpeg", "image/png", "image/jpg"];

    if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
    {
      noPreview();

      $('#message_'+img['id']).html('<div class="alert alert-warning error_messages" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

      return false;
    }

    if ( file.size > maxsize )
    {
      noPreview();
      $('#message_'+img['id']).html('<div class=\"alert alert-danger error_messages\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

      return false;
    }

    /* preview selected image */ 
    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);

  });

});
