
<?php 
  $this->load->module('site_security');
  $this->site_security->_make_sure_logged_in();

  $arrImgNames = array();
  if( count($image_list) == 0 ) {
      $message = '<h4>The system administrator did not provide any upload options at this time.<br>Please try again in the near future.</h4>';
  } else {
      $message = '<h4>Select and click to upload. '.$userid.'</h4>';
  }  
?>

<div class="container">
  <div  class="col-md-12">
    <center><h4><?= $message ?></h4></center>

     <?php $x = 0 ?>

      <form id="upload-image-form" enctype="multipart/form-data">

            <?php foreach( $image_list as $position =>$role ) {
                  $rec_id = empty($users_images[$role][0]) ? 0 : $users_images[$role][0];
                  if(isset($users_images[$role][1]) && !empty($users_images[$role][1])) {
                     $arrImgNames[] = $users_images[$role][1];
                     $imgName = "upload/".$users_images[$role][1]; 
                     $completed_upload = "display: block";
                     $pre_upload = "display: none";
                  } else {
                     $imgName = "public/images/120x90.png";
                     $completed_upload = "display: none";
                     $pre_upload = "display: block";
                  }
                  $x++;
            ?>
            <div class="col-sm-12 col-md-4 col-lg-3">
              <div class="thumbnail" style="min-height: 200px">
                <div class="caption">
                    <p><?= $position.' | '.$role ?></p>
                </div>

                <a href="#" target="_self">
                  <!-- 'http://via.placeholder.com/120x90' -->                
                  <img src="<?= base_url().$imgName ?>" class = "img-responsive"  
                       id="previewImg_<?= $x ?>" style="width: 100%;">
                </a>

                <div style="height: 80px;" >

                <!-- upload file input  -->
                    <div class="caption" id="pre_upload_<?= $x ?>"
                                         style="<?= $pre_upload ?>" >
                       <input type="file" name="file[]" id="imageFile_<?= $x ?>" />
                    </div> 
                <!-- upload file input -->

                    <div class="caption" id="confirm_upload_<?= $x ?>" style="display:none">
                          <a href="#" >
                              <button class="btn btn-md btn-primary" id="upload-button_<?= $x ?>"
                                      type="submit">Upload image
                              </button>                             
                          </a>
                          <a href="#" >
                             <button type="button" id='cancelImg_<?= $x ?>' class="btn btn-default" onClick="javascript: cancel(this) ">Cancel</button>
                          </a>
                    </div>
                    <div class="caption" id="completed_upload_<?= $x ?>"
                                         style="<?= $completed_upload ?>">
                          <a href="#" >
                             <button type="button" id='removeImg_<?= $x ?>' value='<?= $rec_id ?>' class="btn btn-danger" onClick="javascript: remove(this) ">Remove</button>
                          </a>
                    </div>

                </div>
                <div id="message_<?= $x ?>"></div>    
              </div>
            </div>
          <?php } // end foreach 1 ?>

          <div id="message_<?= $x ?>"></div>    

          <input type="hidden" name="total_boxes" id="total_boxes" value='<?= $x ?>' />
          <input type="hidden" name="dbf_images" id="dbf_images"
                               value='<?= json_encode($arrImgNames) ?>' >
                                         
        <div  class="col-md-12">
          <ul class="list-inline pull-right">
              <li><button type="button" 
                          class="btn btn-primary cancel"
                          name ="fld_group1"
                          >Cancel</button></li>          </ul>
       </div>
        
      </form>
  </div>

</div> <!-- conatiner -->
<!-- load common modal -->
<?= $this->load->view('templates/common/modal_alert'); ?> 