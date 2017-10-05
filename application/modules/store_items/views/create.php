<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if( isset( $default['flash']) ) {
    echo $this->session->flashdata('item');
    unset($_SESSION['item']);
  }
  $show_buttons = true;
	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
?>

<style>
  #dimensions{ color: #000; font-weight: bold; font-size: 1em; margin-bottom: 5px; margin-left: 15px; }
</style>

<h2 style="margin-top: -10px;"><small><?= $default['page_header'] ?></small></h2>

<?php if( is_numeric($update_id) ) { ?>
  	<div class="well">
  			<div class="content">
  				<a href="<?= base_url() ?>store_item_colors/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Color</button></a>
  				<a href="<?= base_url() ?>store_item_sizes/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Size</button></a>
  				<a href="<?= base_url() ?>store_cat_assign/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Categories</button></a>

  				<a class ="btnConfirm" id="delete-danger" href="<?= base_url() ?>store_items/deleteconf/<?= $update_id ?>">
            <button type="button" class="btn btn-danger">Delete Product</button></a>

  				<a href="<?= base_url() ?>store_items/view/<?= $update_id ?>/preview"><button type="button" class="btn btn-default">Preview Page</button></a>
  			</div>
  	</div><!-- end well -->
<?php } ?>

            <div class="well well-sm">
               <form id="myForm" method="post" action="<?= $form_location ?>" >                  
<!-- form row -->                  
                <div class="row">
<!-- col-md-5 -->                  
                  <?= validation_errors("<p style='color: red;'>", "</p>"); ?>

                    <div class="col-md-5" style="border: 0px red solid;">
                      <div class="form-group">
                        <label for="Name">Name</label>
                        <div>
                          <input type="text" id="item_title" name="item_title" placeholder="" class="form-control item_title">
                        </div>
                      </div>
                       <div class="row">
                          <div class="col-md-6">
                           <div class="form-group">
                              <label for="Price">Price</label>
                              <div>
                                <input type="text" id="price" name="Price" placeholder="" class="form-control price">
                              </div>
                          </div>
                         </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="SalePrice">On Sale Price</label>
                              <div>
                                <input type="text" id="saleprice" name="SalePrice" placeholder="" class="form-control sale-price">
                              </div>
                            </div>
                         </div>
                       </div>

                      <div class="form-group">
                          <label for="name"> Short Description </label>
                          <textarea name="short_desc" id="short_desc" class="form-control"
                                    rows="2" cols="25"
                                    placeholder="Enter a brief product description"></textarea>
                      </div>

                      <div class="form-group">
                          <label for="name">Full Description</label>
                          <textarea id="input" name="input"></textarea>
                      </div>

                      <div class="row">
                          <div class="col-md-8">
                              <div class="form-group">
                                  <div id="dimensions" >Dimentions(Width x Height X Depth)</div>
                                  <div class="col-lg-4"> 
                                      <input type="text" id="dimentionsWidth" name="DimentionsWidth"
                                             placeholder=""
                                             class="form-control dimentions-width"></div>
                                  <div class="col-lg-4">
                                      <input type="text" id="dimentionsHeight" name="DimentionsHeight"
                                             Placeholder="" 
                                             class="form-control dimentions-height"></div>
                                  <div class="col-lg-4">
                                      <input type="text" id="dimentionsDepth" name="DimentionsDepth"
                                             placeholder="" 
                                             class="form-control dimentions-depth"></div>
                              </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="Weight">Weight</label>
                              <div>
                                <input type="text" id="weight" name="Weight" placeholder="" class="form-control weight">
                              </div>
                            </div>
                          </div>                             
                      </div>

                       <div class="form-group">
                        <label for="ShowBuyButton">Show Product</label>
                        <div>
                          <input type="radio"  name="ShowBuyButton" class="input-xlarge"><span>No</span>
                           <input type="radio"  name="ShowBuyButton" checked class="input-xlarge"><span>Yes</span>
                        </div>
                      </div>
                    </div>  
<!-- col-md-3 -->                    
                    <div class="col-md-3">

                          <!-- load site_ajax_upload view -->
                          <?=  $this->load->view('site_ajax_upload/site_ajax_upload') ?> 
                          <!-- load site_ajax_upload view -->
                                                  
                          <div class="form-group">
                            <br>
                            <label for="ShowBuyButton">Show Image</label>
                            <div>
                              <input type="radio"  name="ShowBuyButton" class="input-xlarge"><span>No</span>
                              <input type="radio"  name="ShowBuyButton" checked class="input-xlarge"><span>Yes</span>
                            </div>
                          </div>                        
                    </div>                    
<!-- col-md-4 -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="ProductType">Product Type</label>
                        <div>
                          <select id="productType" name="ProductType" class="form-control product-type">
                              <option value="0">-Select-</option>
                          </select>
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="Manufacturer">Manufacturer</label>
                        <div>
                          <select id="manufacturer" name="Manufacturer" class="form-control manufacturer">
                              <option value="0">-Select-</option>
                          </select>
                          <p class="help-block btnSubmitForm" id="Manufacturer"><a>Manufacturer Quick Add</a></p>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="Distributor">Distributor</label>
                        <div>
                          <select id="distributor" name="Distributor" class="form-control distributor">
                              <option value="0">-Select-</option>
                          </select>
                          <p class="help-block"><a>Distributor Quick Add</a></p>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="SKU">SKU</label>
                        <div>
                          <input type="text" id="sku" name="SKU" placeholder="" class="form-control sku">
                        </div>
                      </div>
                   
                      <div class="form-group">
                        <label for="ManufacturerPart">Manufacturer Part</label>
                        <div>
                          <input type="text" id="manufacturerPart" name="ManufacturerPart" placeholder="" class="form-control manufacturer-part">
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="TaxClass">Tax Class</label>
                        <div>
                          <select id="taxClass" name="TaxClass" class="form-control tax-class">
                              <option value="0">-Select-</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="QuantityDiscountTable">Quantity Discount Table</label>
                        <div>
                          <select id="quantityDiscount" name="QuantityDiscountTable" class="form-control quantity-discount">
                              <option value="0">-Select-</option>
                          </select>
                          <p class="help-block"><a>Quantity Discount Quick Add</a></p>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="text-left">
                      <button type="submit" class="btn btn-primary"
                                name="submit" value="Submit">Submit</button>
                     <button type="submit" class="btn" 
                              name="submit" value="Cancel">Cancel</button>
                </div>

<!-- end form row  -->
                </form>
            </div>

