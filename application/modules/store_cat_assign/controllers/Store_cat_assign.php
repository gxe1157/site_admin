<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_cat_assign extends MY_Controller
{

/* model name goes here */
public $mdl_name = 'mdl_store_cat_assign';
public $store_controller = 'store_cat_assign';

public $column_rules = array(
        array('field' => 'cat_id', 'label' => 'Category', 'rules' => ''),
);

public $default = [];


function __construct() {
    parent::__construct();
    /* is user logged in */
    $this->default = login_init();  

    $this->default['flash'] = $this->session->flashdata('item');
    $this->default['page_header'] = "Category Assign";
    $this->site_security->_make_sure_logged_in(); 

}

function update( $item_id )
{

    $this->_numeric_check( $item_id );

    // get item title and image from store_items table
    list ($item_title, $small_img) = $this->cntlr_name->_get_item_title_byid($item_id);

    // get sub_catergories from store_catergories
    $sub_categories = $this->cntlr_name->_get_all_sub_cats_for_dropdown();

    // get an array of all assigned to item_id from store_cat_assign
    $query = $this->cntlr_name->_get_assigned_categories('item_id', $item_id, $orderby = null);

    $data['query'] = $query;
    $data['num_rows'] = $query->num_rows();

    foreach ($query->result() as $row) {
       list ($cat_title, $parent_cat_title) = $this->cntlr_name->_get_parent_cat_title($row->cat_id);
       $assigned_categories[$row->cat_id] = $parent_cat_title." > ".$cat_title;
    }

    if(!isset($assigned_categories)){
       if( empty($sub_categories) ) {
            $this->_set_flash_danger_msg("A <b>Sub Category</b> has not been assined.<br>Go to Manage Categories and click on \"Add Sub Category\" button.");
        }
       $assigned_categories ="";
     } else {
        // Item has been assigned to at least one catergory
        $sub_categories = array_diff( $sub_categories, $assigned_categories );
     }

    $data['assigned_categories'] = $assigned_categories;
    $data['options']         = $sub_categories;
    $data['cat_id']          = $this->input->post('cat_id',TRUE);
    $data['options_hdr']     = 'Assign New Categories';

    $data['item_title']= $item_title;
    $data['small_img']= $small_img;
    $data['item_id']   = $item_id;

    $data['custom_jscript'] = [ 'public/js/datatables.min',
                                'public/js/site_datatable_loader',
                                'public/js/format_flds'
                                ];

    $data['page_url'] = "update";
    $data['view_module'] = 'store_cat_assign';
    $data['title'] = "Manage Categories Accounts";

    $this->default['page_title'] = "Manage User Accounts";
    $data['default'] =  $this->default;  

    $this->load->module('templates');
    $this->templates->admin($data);        
}


function delete( $update_id )
{
    $this->_numeric_check($update_id);
    $this->_security_check();

    $item_id = $this->cntlr_name->_get_assigned_id($update_id);
    $this->_delete($update_id);
    $this->_set_flash_msg("The item was successfully removed.");

    redirect($this->store_controller.'/update/'.$item_id);
}

function submit( $item_id )
{
    $this->_numeric_check($item_id);
    $this->_security_check();

    $submit = $this->input->post('submit', TRUE);
    $cat_id = trim($this->input->post('cat_id', TRUE));

    if($submit == "Finished"){
        redirect('store_items/create/'.$item_id);
    } elseif ($submit == "Submit" ){
        // Insert new option
        if($cat_id!=''){
            $data['item_id'] = $item_id;
            $data[ 'cat_id'] = $cat_id;
            $this->_insert($data);

            $cat_title = $this->cntlr_name->_get_cat_title( $cat_id );

            $this->_set_flash_msg("The item was successfully assigned to the ".$cat_title." category.");
        }
    }
    redirect( $this->store_controller.'/update/'.$item_id);
}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */




/* ===============================================
    Call backs go here...
  =============================================== */




/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
