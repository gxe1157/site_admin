
/* Build obj to be used by model_js */
var model_js_mess = {
        'delete' : '<h3>Delete this product?</h3>',
        'fldNames' : ['company', 'contact', 'address1', 'city', 'state', 'zip', 'Phone', 'email']
    }
/* Build obj to be used by model_js */


$(document).ready(function() {
    let change_occurred = false;
    $('#myForm').on( 'focus', ':input', function(){
        $(this).attr( 'autocomplete', 'off' );
    });
    
    /* Save and continue */
    $('#myForm :input').change(function(e){
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
          url: '../', 
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
