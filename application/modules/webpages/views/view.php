
<div class="row">
  <div class="col-md-4" style="margin-top: 24px;">
  	<img src="<?= base_url() ?>public/big_pic/<?= $big_pic ?> " class="img-responsive" alt="<?= $item_title ?>">
  </div>
  <div class="col-md-5">
  		<h1><?= $item_title ?></h1>	
  		<div style="clear:both;"></div>
		<?= nl2br($item_description) ?>
  </div>  

  <!-- Add drop down select options here cart/_draw_add_to_cart  -->
  <div class="col-md-3" style=" background-color: #ddd; margin-top: 24px; border: 3px solid #666; border-radius: 9px;" >
  		<div class="row"><?= Modules::run('cart/_draw_add_to_cart', $update_id); ?></div>
  </div>
</div>