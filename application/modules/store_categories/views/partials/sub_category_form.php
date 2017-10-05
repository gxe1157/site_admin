
			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			  <fieldset>
				<?php

				if( $num_dropdown_options > 1 && $this->uri->segment(4) ){ ?>

					<div class="control-group">
						<label class="control-label" for="selectStatus">Parent Category:</label>
						<div class="controls">
							<?php
							$additional_opt = " id = selectStatus";
							echo form_dropdown('parent_cat_id', $options, $columns['parent_cat_id'], $additional_opt);
							?>
						</div>
					</div>

				  <?php
				} else {
					$columns['cat_title'] = '';
        			echo form_hidden('parent_cat_id', $this->uri->segment(3));
				}
				?>

				<div class="control-group">
				<h3>sub_category form... </h3>
				  <label class="control-label" for="typeahead">Sub Category Title</label>
				  <div class="controls">
					<input type="text" class="span6" name = "cat_title" value="<?= $columns['cat_title'] ?>">
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="Return">Return</button>
				</div>
			  </fieldset>
			</form>
