	<ul class="nav navbar-nav">
		<?php		
		foreach ($parent_categories as $parent_cat_id => $sub_cat_title) { ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<?= $parent_cat_id ?>
				<span class="caret"></span></a>
				
				<ul class="dropdown-menu">
	 				<?php
					foreach( $sub_cat_title as $line ) {
						$category_url = $line->category_url;
						echo '<li><a href="'.$target_url_start.$category_url.'">'.$line->cat_title.'</a></li>';
					} ?>	
				</ul>
			</li>
		<?php
		}
		?>
	</ul>