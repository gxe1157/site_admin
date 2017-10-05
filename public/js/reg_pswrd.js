
/*----- jquery -----*/
$(document).ready(function() {

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
                password: {
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

});
