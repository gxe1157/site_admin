<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$message = " To complete your account activation choose and enter your password here. Please note that your password cannot be the same as your username or email.";

?>

      <div id="new_password" style="display:block; margin-top: 10px; height: 400px;">
      <div class="col-md-6 col-md-offset-3" style="margin-top: 10px;">

      <div class="alert alert-info">
        <i class="fa fa-coffee"></i><?= $message ?>
        <!-- Your password cannot be the same as your username. -->
      </div>      

      <?= validation_errors("<p style='color: red;'>", "</p>"); ?>

      <form id="enableForm" method="post" class="form-horizontal" action="youraccount/activate">
          <input type="hidden" name="activate_code" value="<?= $activate_code ?>">

          <div class="form-group">
              <label class="col-md-4 control-label">New password</label>
              <div class="col-md-7">
                  <input type="password" class="form-control" name="password" />
              </div>
          </div>

          <div class="form-group">
              <label class="col-md-4 control-label">Confirm password</label>
              <div class="col-md-7">
                  <input type="password" class="form-control" name="confirm_password" />
              </div>
          </div>

          <div class="form-group ">
            <div class="col-md-6">            
              <button type="button" class="btn  btn-block" id="cancel-btn"
                      name="cancel" value="Cancel">Cancel</button>        
            </div>          
            <div class="col-md-6">            
              <button type="submit" class="btn btn-primary btn-block"  id="submit-btn"
                      name="submit-form"  value="Submit">Activate Account</button>
            </div>                      
          </div>

      </form>

      </div><!--/col-md-6-->
      </div><!--/id new_password-->

