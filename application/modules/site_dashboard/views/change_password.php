<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

      <div id="new_password" style="display:none; margin-top: 10px;">
      <div class="col-sm-8 col-sm-offset-2">

      <div class="alert alert-info alert-dismissable">
        <i class="fa fa-coffee"></i>
        Use the form below to change your password. On completion you will be redirected to the login page. Use the new passwrod to login.
        <!-- Your password cannot be the same as your username. -->
      </div>      

      <?= validation_errors("<p style='color: red;'>", "</p>"); ?>

      <form id="enableForm" method="post" class="form-horizontal" action="youraccount/change_password">
           <div class="form-group">
              <label class="col-md-4 control-label">Current Password(*)</label>
              <div class="col-md-7">
                  <input type="text" class="form-control" name="current_password" />
              </div>
          </div>

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
                      name="submit-form" value="Submit">Change Password</button>
            </div>                      
          </div>
      </form>

      </div><!--/col-sm-6-->
      </div><!--/id new_password-->

