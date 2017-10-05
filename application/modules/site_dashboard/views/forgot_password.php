<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $div_style= ( isset($flash) && !empty($flash) ) ? "display: none; " : " display: block; ";
?>

<div class="row">
  <div class="col-md-4 col-md-offset-4" style="height:420px; text-align: left;">

      <?= validation_errors("<p style='color: red;'>", "</p>"); ?>

      <h2>Forgot Password?</h2>
      <p>You can reset your password here.</p>      
      
      <div style='<?= $div_style ?>' >
      <form class="form-signin" action="<?= base_url() ?>youraccount/forgot_password" method="POST">
        <fieldset>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
              
              <input id="emailInput" name="email" placeholder="email address" class="form-control" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
            </div>
          </div>
          <div class="form-group">
            <input class="btn btn-lg btn-primary btn-block" name="submit" value="Send My Password" type="submit">
          </div>
        </fieldset>
      </form>
      </div>

      <?php if( isset($flash) ) echo $flash; ?>

  </div>
</div>

