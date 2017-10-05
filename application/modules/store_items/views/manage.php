<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
	$redirect_url = base_url().'store_items/create/';
?>

<h2 style="margin-top: -5px;"><small><?= $default['page_title'] ?></small></h2>
<p style="margin-top: 30px,">
	<a href="<?= base_url().$this->uri->segment(1) ?>/create" >
		<button type="button" class="btn btn-primary"><?= $default['add_button'] ?></button></a>
</p>

<div class="row">		
	<div class="col-md-12">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
				  <tr>
					  <th>Item Tile</th>
					  <th>Price</th>
					  <th>Was Price</th>
					  <th>Status</th>
					  <th>Image</th>					  
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

			    <?php
			    	 foreach( $columns->result() as $row ){
			    	 	$edit_url = $redirect_url.$row->id;			    	 	
			    	 	$status = $row->status;
			    	 	if( $status == 1) {
			    	 		$status_label = "success";
			    	 		$status_desc  = "Active";
			    	 	} else {
			    	 		$status_label = "defaults";
			    	 		$status_desc  = "Inactive";			    	 		
			    	 	}	
			    	 	$image = $row->big_pic == "" ? "No" : "Yes";
			    ?> 	
						<tr>
							<td class="right"><?= $row->item_title ?></td>
							<td class="right"><?= $row->item_price ?></td>
							<td class="right"><?= $row->was_price ?></td>
							<td class="center">
								<span class="label label-<?= $status_label ?>"><?= $status_desc ?></span>
							</td>
							<td class="center">
								<span class="label label-<?= $status_label ?>"><?= $image ?></span>
							</td>
							<td class="center">
								<a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info btn-sm"
								   style="font-size: 12px; padding: 0px 5px 0px 0px;"
								   href="<?= $edit_url ?>">
								   <i class="fa fa-pencil fa-fw"></i> Edit
								</a>
							</td>
						</tr>
			    <?php } ?>

			  </tbody>
		  </table>    

	</div><!--/span-->

</div><!--/row-->