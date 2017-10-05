<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}

	$store_location = base_url().$this->uri->segment(1)."/submit/".$update_id;
	?>

<h2 style="margin-top: -10px;"><small><?= $default['page_header'] ?></small></h2>


<div class="row">
	<div class="col-md-12">
	<?= validation_errors("<p style='color: red;'>", "</p>") ?>
			<!-- show image -->
			<img src="http://via.placeholder.com/175x175";
			               class="img-responsive img-thumbnail";
			               style="width: 175px; height:175px;"
			               alt="#"
			               id="previewImg">			
			<h4>Item Title: <?= $item_title ?></h4>				      

			<p>Submit new options as required. When you are finished adding new options, press 'Finished' </p>

			<form class="form-horizontal" method="post" action="<?= $store_location ?>" >

				<div class="form-group">
				  <div class="col-md-5">
					<input type="text" class="form-control" name = "new_option" value="">
				  </div>
				</div>

  				  <div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
						<button type="submit" class="btn" name="submit" value="Finished">Finished</button>
				  </div>
			</form>   
		</div>
	<p>&nbsp;</p>		
</div><!--/row-->

<?php if( true ){ ?>	
	<div class="row">		
		<div class="col-md-12">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
				  <tr>
					  <th>Count</th>
					  <th><?= $options_hdr ?></th>
					  <th>Action</th>
				  </tr>
			  </thead>   
			  <tbody>

			    <?php
		        $count = 0;
			   	foreach( $query->result() as $row ){
		    	 	$count++;
		    	 	$delete_url = base_url().$this->uri->segment(1)."/delete/".$row->id;
					?> 	
						<tr>
							<td><?= $count ?></td>
							<td class="right"><?= $row->$store_db_column ?></td>
							<td class="center">
								<a class="btn btn-danger" href="<?= $delete_url ?>">
									<i class="halflings-icon white trash"></i> Remove Option  
								</a>
							</td>
						</tr>
			    <?php } ?>

			  </tbody>
		  </table>            
		</div>	
	</div><!--/row-->
<?php } ?>
