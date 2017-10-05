<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}


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
					  <th>Last</th>
					  <th>First</th>
					  <th>Membership</th>
					  <th>Email</th>
					  <th>Joined</th>
					  <th>Expire Dt</th>					  
					  <th>Status</th>					  					  
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

					<?php
						$this->load->module('timedates');					
						foreach( $columns->result() as $row ) {
						    if( $row->is_delete > 0 ){
						        $show_status = 'Deleted';
						        $type = "danger";
						    } else {
						        $show_status = $row->status == 2 ? 'Suspened' : 'Acitve';
						        $type = $row->status == 2 ? 'warning' : 'primary';;
						    }							
							$edit_url = base_url().$this->uri->segment(1)."/create/".$row->id;
							$create_date = convert_timestamp($row->create_date, 'datepicker_us'); ?>
						<tr>
							<td class="right"><?= $row->last_name ?></td>
							<td class="right"><?= $row->first_name ?></td>
							<td class="right"></td>
							<td class="right"><?= $row->email ?></td>
							<td class="right"><?= $create_date ?></td>
							<td class="right"> --- </td>
							<td class="right"><span class="label label-<?= $type ?>"> <?= $show_status ?> </span></td>							

							<td class="center">
								<a class="btn btn-info btn-sm" style="font-size: 12px; padding: 0px 5px 0px 0px;" href="<?= $edit_url ?>">
									<i class="fa fa-pencil fa-fw"></i> Edit
								</a>
							</td>
						</tr>
			    	<?php } ?>			    

			  </tbody>
		  </table>            

	</div><!--/span-->

</div><!--/row-->