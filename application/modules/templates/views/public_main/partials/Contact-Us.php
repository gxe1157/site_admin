
<style>
 #success_message{
     display: none;
 }

</style>

<div  class="col-md-12 this_page">
  <div style="text-align: center;">
      <h5><b>The NJ Law Enforcement Police Officers Brotherhood</b></h5>
      <p style="margin-top: -8px; margin-bottm: 5px;">195 Paterson Ave, Little Falls NJ 07424<br />
       Phone: 973-256-7390&nbsp;&nbsp;&nbsp;&nbsp; Fax: 973-256-7391
      </p>
  </div>

  <form class="form-horizontal" action="<?= base_url() ?>default_module/ajaxPost" method="POST" id="contact_form">
    <fieldset>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label">First Name</label>
      <div class="col-md-7 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
        </div>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label" >Last Name</label>
        <div class="col-md-7 inputGroupContainer">
        <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input name="last_name" placeholder="Last Name" class="form-control"  type="text">
        </div>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label">Phone #</label>
        <div class="col-md-7 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
      <input name="phone" placeholder="(845)555-1212" class="form-control" type="text">
        </div>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label">E-Mail</label>
      <div class="col-md-7 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
        </div>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-3 control-label">Confirm E-Mail</label>
        <div class="col-md-7 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input name="confirmEmail" placeholder="Confirm E-Mail Address" class="form-control"  type="text">
        </div>
      </div>
    </div>

    <!-- Text area -->

    <div class="form-group">
      <label class="col-md-3 control-label">Message</label>
        <div class="col-md-7 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
            	<textarea class="form-control" name="comment" placeholder="Enter Message.....  "></textarea>
      </div>
      </div>
    </div>

    <!-- Success message -->
    <div class="col-md-3" >&nbsp;</div>
    <div class="col-md-7 alert alert-success" role="alert" id="success_message"> Success <i class="glyphicon glyphicon-thumbs-up"></i><br>Thanks for contacting us, we will get back to you shortly.</div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-7">
        <button type="submit" class="btn btn-warning btn-block" id="submission">Send <span class="glyphicon glyphicon-send"></span></button>
      </div>
    </div>

    </fieldset>
  </form>
  </div>
</div><!-- /.container -->


<script>

$(document).ready(function() {

    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
            last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            confirmEmail : {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    identical: {
                        field: 'email',
                        message: 'The email and its confirm are not the same'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Please select your state'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your zip code'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Please supply a vaild zip code'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of your project'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...

            $('#contact_form').bootstrapValidator("resetForm", true);
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            // console.log( $form.attr('action'), $form.serialize() );
            $.post($form.attr('action'), $form.serialize(), function(result) {
                $('#submission').hide();
                console.log(result);
            });
        });
});

</script>
