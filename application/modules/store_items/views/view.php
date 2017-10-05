<?php
  echo Modules::run('templates/_draw_breadcrumbs', $breadcrumbs_data);
?>

<div class="row">
  <div class="col-md-3" style="margin-top: 24px;">
  	<img src="<?= base_url() ?>public/big_pic/<?= $big_pic ?> " class="img-responsive" alt="<?= $item_title ?>">
  </div>
  <div class="col-md-6">
  		<h2><?= $item_title ?></h2>
  		<div style="clear:both;"></div>
		  <?= nl2br($item_description) ?>

    <!-- Add table data here cart/_draw_price_table_to_cart -->
    <div class="row">
      <?php
        if( $item_setup == 2 ){
          echo Modules::run('cart/_draw_table_to_cart', $update_id);
        }
        // echo '<h3>... '.$item_setup.'</h3>';        
      ?>
    </div>

  </div>

  <!-- Add drop down select options here cart/_draw_add_to_cart  -->
  <div class="col-md-3">
     <div class="row">
  		  <?= Modules::run('cart/_draw_add_to_cart', $update_id); ?>
     </div> 
  </div>
</div>
