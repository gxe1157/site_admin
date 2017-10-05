<?php
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
?>

<h2 style="margin-top: -5px;"><small><?= $default['page_title'] ?></small></h2>

<p style="margin-top: 30px,">

	<?php
    	$this->load->module($site_controller);

		echo '<a href="'.$add_button_url.'" >
		<button type="button" class="btn btn-primary">'.$add_button.'</button></a> ';

		$parent_cat_title = '';
		if( $mode == 'sub-category'){
			echo '<a href="'.$cancel_button_url.'" >
			<button type="button" class="btn btn-default">Manage Categories</button></a>';

			if( count($columns->result()) > 0 ){
				// Lookup Parent Id for subcategory listing
				$col_array = $columns->result();
				$parent_id = $col_array[0]->parent_cat_id;
				$parent_cat_title = $this->$site_controller->_get_cat_title( $parent_id );
			}
		}
    ?>
</p>

<div class="row">		
	<div class="col-md-12">
			<table id="example"  class="table table-striped table-bordered">
			  <thead>
				  <tr>
					  <th>Category Tile</th>
					  <th>Parent Category</th>
					  <th>Sub Categories</th>
					  <th class="text-center">Actions</th>
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	foreach( $columns->result() as $row ){
					  	$num_sub_cats = isset($sub_cats[$row->id]) ? $sub_cats[$row->id] : 0;
			    	 	$edit_url = $redirect_base."/create/".$row->id;
			    	 	$view_url = $redirect_base."/create/".$row->id;

			    	 	if($row->parent_cat_id==0) {
			    	 	 	$parent_cat_title='--';
			    	 	} else {
							if( $parent_cat_title =='' ) $parent_cat_title = $row->cat_title;
				    	}

				        $entity = $num_sub_cats == 1 ? "Category" : "Categories";
				    	$sub_cat_url = $redirect_base.'/manage/'.$row->id.'/sub-category';
				    	$add_cat_url = $redirect_base.'/create/'.$row->id.'/add_sub-category';
			    ?>
						<tr>
							<td class="right"><?= $row->cat_title ?></td>
							<td class="right"><?= $parent_cat_title ?></td>
							<td class="right">
							    <?php if( $num_sub_cats < 1 ){
								    	if( $row->parent_cat_id !=0 ){
								            echo '-';
								    	}else{
									       	echo '<a class="btn btn-small btn-primary" href="'.$add_cat_url.'">Add Sub Category</a>';
										}

							        } else {
										echo '<a class="btn btn-default" href="'.$sub_cat_url.'">
										<i class="fa fa-eye" aria-hidden="true"></i> '.$num_sub_cats." ".$entity.'</a>';
								    } ?>
					        </td>
							<td class="text-center">
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
