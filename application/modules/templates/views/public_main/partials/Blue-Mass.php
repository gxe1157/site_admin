<?php
  $href_target = base_url();

  $img_thumb_nails = array( 
  'Blue-Mass-2004'=>'Blue_Mass_2004_th.jpg', 'Blue-Mass-2005'=>'Blue_Mass_2005_th.jpg',
  'Blue-Mass-2006-07'=>'Blue_Mass_2006_07_th.jpg', 'Blue-Mass-2008'=>'Blue_Mass_2008_th.jpg',
  'Blue-Mass-2009'=>'Blue_Mass_2009_th.jpg', 'Blue-Mass-2010'=>'Blue_Mass_2010_th.jpg',
  'Blue-Mass-2013'=>'Blue_Mass_2013_th.jpg', 'Blue-Mass-2014'=>'Blue_Mass_2014_th.jpg',
  'Blue-Mass-2015'=>'Blue_Mass_2015_th.jpg'
   );

?>

<div  class="col-md-12">
	<div  class="col-md-12">
		<img src="<?= base_url(); ?>public/images/blue-mass/BlueMassHeading.jpg"
			 class="img-responsive"	width="100%" height="100%"
			 border="2" />

	    <center><h4>Click below to veiw articles these past Blue Mass events</h4></center>

		<?php foreach( $img_thumb_nails as $name=>$img_display ) { ?>
			<div class="col-sm-12 col-md-4 col-lg-3">
			      <div class="thumbnail">
			        <a href="<?= $href_target; ?><?= $name ?>" target="_self">
			          <img src="<?= base_url(); ?>public/images/Blue-Mass/<?= $img_display ?>" 
			          class = "img-responsive"	
			          alt="Blue Mass"

	                  style="width: 160px; height: 140px;">

			          <div class="caption">
			            <p><?= $name ?></p>
			          </div>
			        </a>
				</div>
			</div>
		<?php
		} // end foreach 1
		?>

	</div>
</div>
