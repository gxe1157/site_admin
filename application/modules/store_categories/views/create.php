<h2 style="margin-top: 10px; ma">
					<small><?= $default['page_title'] ?></small></h2>	

<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;

	$data['form_location'] = $redirect_base."/create/".$update_id;
	$data['site_controller'] = $site_controller;

	if( $mode == ''){
		$data['parent_cat_id'] = 0;
	} else {
	    $data['parent_cat_id'] = !is_numeric($parent_cat_id) ? 0 : $parent_cat_id;
	    $data['mode'] = $mode;
	}
?>

<div class="row">
	<div class="col-md-12">
		<div class="content">
			<?php
			//  echo 'mode: '.$mode.'  | '.$data['parent_cat_id'];
				$category_form = $mode == 'sub-category' ?
										  'sub_category_form' : 'category_form';
				echo $this->load->view($view_module.'/partials/'.$category_form ,$data );
    		?>
		</div>
	</div><!--/span-->

</div><!--/row-->
