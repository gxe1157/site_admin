<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- special case data fetch -->
<?php
  $data['ad_plans'] = isset($ad_plans) ? $ad_plans : '';
?>

<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('html_head');?>

<body>
  <!--main container for page  -->
  <div class="container">
<!-- header image -->
      <div class="row">
        <div class="col-sm-12"
             style="padding: 10px 0 0 0; width: 100%; border: 0px red solid">

          <img class="img-responsive"
               src="<?= base_url() ?>public/images/sec_hdr.jpg"
               alt="NJPOB" style="width: 1200px; height: 190px;">
        </div>
      </div>
      <!-- //header image -->

<!-- top nav menu -->
      <!-- data for top nav bar come from template module -->
     <?php  $this->load->view('html_top_menu.php'); ?>
      <!-- // top nav menu -->

<!-- main content row  -->
      <div class="row">
          <!-- aside nav to left-->
            <?php
                if($left_side_nav == true){
                    $data['user_avatar'] = isset($user_avatar) ? : '';
                    $nav_module = $view_module == 'partials' ? '': $view_module.'/';
                    $this->load->view( $nav_module.'html_aside', $data = null);
                }  
            ?>
          <!-- // aside nav to left-->

          <!-- content on right -->
          <?php $col_width = $left_side_nav ? 10 : 12; ?>       

          <div class="col-sm-<?= $col_width ?> text-left">
              <!-- breadcrubm line  -->
              <div class="row">
                  <div class="col-sm-12" id="menu-mess-header">
                      <?= $page_title; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= $view_module.'/'.$contents ?>
                      <!-- <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Library</a></li>
                        <li class="active">Data</li>
                      </ol> -->
                  </div>
              </div>
              <!-- // breadcrubm line  -->
              <div class="row">
                  <div class="col-sm-12" >
                    <?php $this->load->view($view_module.'/'.$contents, $data=null); ?>
                  </div>  
              </div>
          </div>
          <!-- //content on right -->
          
        </div>
        <!-- // main content row  -->

<!-- Footer -->
        <div style="clear:both;"></div>
        <?php $this->load->view('html_footer'); ?>
        <!-- // Footer -->        

    </div>
    <!-- // main container for page  -->

</body>
</html>
