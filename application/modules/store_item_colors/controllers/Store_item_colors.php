<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Store_item_colors extends MY_Controller 
{

/* model name goes here */
var $mdl_name = 'mdl_store_item_colors';

public $store_db_column = 'item_color';
public $default =[];

function __construct( )
{
    parent::__construct();
    /* is user logged in */
    $this->default = login_init();  

    $this->default['flash'] = $this->session->flashdata('item');
    $this->default['page_header'] = "Update Item Colors";
    $this->site_security->_make_sure_logged_in(); 

}

/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

function update( $update_id )
{
    $this->_numeric_check($update_id);    

    // get item color from store_items_color table
    list ($item_title, $small_img) = $this->cntlr_name->_get_item_title_byid($update_id);
    $data['item_title'] = $item_title;
    $data['small_img']  = $small_img;

    // get existing options
    $data['query']     = $this->get_where_custom('item_id', $update_id, $this->store_db_column);

    $data['options_hdr'] = 'Color';    
    $data['update_id'] = $update_id;    
    $data['num_rows']  = $data['query']->num_rows();
    $data['store_db_column'] = $this->store_db_column;

    $data['custom_jscript'] = [ 'public/js/datatables.min',
                                'public/js/site_datatable_loader',
                                'public/js/format_flds'
                                ];

    $data['page_url'] = "update";
    $data['view_module'] = 'store_item_colors';
    $data['title'] = "Manage Categories Accounts";

    $this->default['page_title'] = "Update Item Colors";
    $data['default'] =  $this->default;  

    $this->load->module('templates');
    $this->templates->admin($data);        

}


function submit( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $submit = $this->input->post('submit', TRUE);
    $new_option = trim($this->input->post('new_option', TRUE));

    if($submit == "Finished"){
        redirect('store_items/create/'.$update_id);
    } elseif ($submit == "Submit" ){
        // Insert new option
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'new_option', 'New Option', 'required');

        if($this->form_validation->run() == TRUE) {
            $data['item_id'] = $update_id;
            $data[ $this->store_db_column ] = $new_option;
            $this->_insert($data);
            $this->_set_flash_msg("The new option was sucessfully added.");          
        }
        redirect($this->uri->segment(1).'/update/'.$update_id);        
        // $this->update($update_id);
    }
}

function delete( $update_id )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $item_id = $this->cntlr_name->_get_item_id($update_id);
    $this->_delete($update_id);
    redirect($this->uri->segment(1).'/update/'.$item_id);
    // $this->update($item_id);    
}



/* ===============================================
    Call backs go here...
  =============================================== */


/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


}