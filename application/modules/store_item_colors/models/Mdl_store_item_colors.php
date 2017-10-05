<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_item_colors extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "store_item_colors";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */


function _get_item_id($id){
    $data = $this->db->get_where('store_item_colors', array('id' => $id) )->result()[0];
    $item_id = $data->item_id;
    return $item_id ;
}    
  
function _get_item_title_byid($id)
{
    $data = $this->db->get_where('store_items', array('id' => $id) )->result()[0];
    $title  = $data->item_title;
    $small_img = $data->small_pic ? : null;
    return array( $title, $small_img );
}   


/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */


}