<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


  if( isset( $default['flash']) ) {
      echo $this->session->flashdata('item');
      unset($_SESSION['item']);
  }

  $first_bit = $this->uri->segment(1);
  $form_location = base_url().$first_bit.'/submit_login';
?>

<div class="row">
  <div class="col-md-4 col-md-offset-4" style="height:420px;">

      <?= validation_errors("<p style='color: red;'>", "</p>"); ?>

      <form class="form-signin" action="<?= base_url() ?>site_dashboard/submit_login" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputText" class="sr-only">Username or Email address</label>
        <input type="text" id="inputText" class="form-control"
               name="username" placeholder="Username or Email address"
               autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <br />
        <input type="password" id="inputPassword" name = "pword"
               class="form-control" placeholder="Password">

        <br />       
        <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                  <input type="checkbox" value="remember-me"> Remember me
              </div>
           </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                 <a href="<?= base_url() ?>site_dashboard/forgot_password"> Forgot Password? </a>
                 <a href="<?= base_url() ?>site_dashboard/contactus"> Membership Support</a>
              </div>
           </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" 
                type="submit" name="submit" value="Submit">Sign in
        </button>

      </form>
  </div>
</div>

