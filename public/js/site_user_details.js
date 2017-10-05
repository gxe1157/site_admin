
var model_js_mess = {
        'delete' : '<h3>Delete this user account?</h3>',
        'suspend': '<h3>Suspend this user account?</h3>',
        'reset_pswrd' : '<h3>Reset Password?</h3>'
    }


$(document).ready(function() {
    let change_occurred = false;
    $('#users_admin').on( 'focus', ':input', function(){
        $(this).attr( 'autocomplete', 'off' );

        // let user_status = $('#user_status').val();
        // if( user_status == 1 ){
        //     $("#users_admin :input").attr("disabled", true).click();
        //     $("#cancel :input").attr("disabled", false);
        // }

    });
    
    $("#delete-danger").click(function (e) {
       e.preventDefault();
    });            

    /* Save and continue */
    $('#users_admin :input').change(function(e){
        // console.log($(e.target).attr('id'));
        // change_occurred = true;
    });

    $("button.btn-primary").click(function (e) {
       /* This will do server side validation */    
       // if( change_occurred ) save_changes_ajax( this.id ); 
    });

    function save_changes_ajax( id ){
        const update_flds = {};
        let formData = new FormData();
        let div_id = id.split('-');

		let jdata = div_id[1]; // This is the id of the div we want data from.
        let getData = $('#'+jdata).find(':input').serializeArray();

        formData.append( 'fld_group', div_id[1] );              
        formData.append( 'id', div_id[2]);                            
        $.each(getData, function(i, field){
            formData.append( field.name, field.value);  
            update_flds[field.name] = field.value; 
            console.log('jdata', field.name, field.value );
        });

        $.ajax({
          url: '../site_users/save_changes_ajax', 
          method:"POST",
          data: formData,
          contentType: false,
          cache: false,
          processData:false,
          success:function(data)
          {
    		    $(".clear_error_mess").html('');          	
            console.log( 'Return Data:......  ', data);
            if( data == 1 ) {
                console.log('Success server side validation.............' );
                $("div .modal-header").addClass("modal-header-success");                
                $('#success').modal('show');

                if( update_flds['first_name'] || update_flds['last_name'] )
                   $('#fullname').html( update_flds['first_name']+' '+update_flds['last_name']);

                change_occurred = false;
                // console.log('update_flds',update_flds);

            } else {
        				let error_message = JSON.parse(data);
        				for ( var key in error_message ) {
        					if (error_message.hasOwnProperty(key)){
        						if( key !== 'contains' ) {
        							$('.'+key).html(error_message[key]);							 
        						}
        					}
        				}
            }
          }// success

        })  
    }
});