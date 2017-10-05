<style>

/*  store_catagories */
#view_small_pic{
	margin: 6px; min-height: 225px;";
}
#view_price{
	style="clear: both; color: red; font-weight: bold;
}
#view_was_price{
	margin-left: 5PX; font-weight: normal; color: #999; text-decoration: line-through; 
}

</style>


<h1><?= $cat_title ?></h1>
 <p><?= $showing_statement ?></p>
 <?= $pagination ?>

<div class="row">
	<?php foreach($query->result() as $row) {
		$item_title = $row->item_title;
		$small_pic  = $row->small_pic;
		$item_price = $row->item_price;		
		$was_price  = $row->was_price;
		$small_pic_path = base_url()."public/small_pic/".$small_pic;
		$item_page  = base_url().$item_segments.$row->item_url;
	?>
		<div class="col-md-2 img-thumbnail" id="view_small_pic" >
			<a href="<?= $item_page ?>" ><img src="<?= $small_pic_path ?>"
				class="img-responsive" title="<?= $item_title ?>" ></a>
			<br>
			<h6><a href="<?= $item_page ?>" ><?= $item_title ?></a></h6>
			<div id="view_price" >
					<?= $currency_symbol.number_format($item_price,2) ?>
				<?php
				if( $was_price > 0 ) { ?>
				<span id='view_was_price'>
					<?= $currency_symbol.number_format($was_price, 2) ?>
				</span>
				<?php } ?>
			</div>

		</div>
	<?php } ?>
</div>
 <?= $pagination ?>

