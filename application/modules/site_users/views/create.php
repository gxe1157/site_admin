<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if( isset( $default['flash']) ) {
    echo $this->session->flashdata('item');
    unset($_SESSION['item']);
  }
  $show_buttons = true;
	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
?>
<h2 style="margin-top: -10px;"><small><?= $default['page_header'] ?></small></h2>

<!-- "../public/images/annon_user.png"  -->
<div class="row">
  <div class="col-md-2" style="border: px solid red; ">
    <img src="<?= base_url().'upload/'.$default['avatar_name'] ?>"
         class="img-thumbnail"
         style="width: 175px; height:150px;"
         alt="avatar"  
         id="previewImg">
         <h3 style="margin-top: 0px; text-align:center;"><small><?= $default['username'].' - '.$update_id ?></small></h3>
  </div>     
  <div class="col-md-10" style="border: 0px solid red; ">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
  </div>
</div>

<div class="row">

<?php
    if( $default['user_is_delete'] > 0 ){
      echo '<div class="col-sm-4 col-md-4 alert alert-danger">
                <strong>Alert!</strong> This user account has been Deleted.
            </div>';      
      $show_buttons = false;
            
    } else if( $default['user_status'] == 2 ) {
      echo '<div class="col-sm-4 col-md-4 alert alert-warning">
                <strong>Alert!</strong> This user account has been Suspened.
            </div>';      
    }             
?>

<div class="col-md-12" style="border-top: 2px #F5F5F5 solid;">
<br>  
<!-- form goes here -->
      <form id="users_admin" class="form-horizontal" method="post" action="<?= $form_location ?>" >
        <input type="hidden" id="user_status" name="user_status" value="<?= $default['user_status'] ?>" >
        <fieldset>          
          <?php
            foreach( $columns as $key => $value ) {
              if( in_array($key, $columns_not_allowed ) === false ) {
          ?>    
      
              <div class="form-group">
                <label for="<?= $key ?>"
                     class="col-sm-4 col-md-4 control-label"><?= $labels[$key] ?></label>

                <div class="col-sm-6 col-md-5">
                            <input type="text"
                                 id="<?= $key ?>"
                                 name="<?= $key ?>" 
                                 class="form-control"
                                 value="<?= $value ?>">

                  <div style="color: red; "><?php echo form_error($key); ?></div>
                </div>
              </div>

            <?php } } ?>
   
          <div class="form-actions">
            <div class="col-sm-6 col-sm-offset-4 col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary"
                        name="submit" value="Submit">Submit</button>

              <button type="submit" class="btn" 
                      name="submit" value="Cancel">Cancel</button>
            </div>        
          </div>

        </fieldset>
      </form>   
      <br>
</div>
</div>

<div class="row">
<div class="col-md-12 ">
<div class="well">
 
<?php if( is_numeric($update_id) && $show_buttons): ?>
  <!-- use bootstrap alert codes: warning, danger etc. -->
  <a class ="btnConfirm" id="reset_pswrd-warning"
     href="<?= base_url().$this->uri->segment(1) ?>/update_password/<?= $update_id ?>">
    <button type="button" class="btn btn-primary">Reset Password</button></a>
 
    <?php if($default['user_status'] == 2): ?>
      <a href="<?= base_url().$this->uri->segment(1) ?>/change_account_status/<?= $update_id ?>/1">      
        <button type="button" class="btn btn-primary">Re-activate Account</button></a>
    <?php else: ?>    
      <a href="<?= base_url().$this->uri->segment(1) ?>/change_account_status/<?= $update_id ?>/2">      
        <button type="button" class="btn btn-primary">Suspend Account</button></a>
    <?php endif; ?>    


  <a class ="btnConfirm " id="delete-danger"
     href="<?= base_url().$this->uri->segment(1) ?>/delete/<?= $update_id ?>/<?= $default['username'] ?>">
    <button type="button" class="btn btn-danger">Delete Account</button></a>

<?php endif ?>   

</div>    
</div>
</div>
