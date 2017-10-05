<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_item_sizes extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "store_item_sizes";
    return $table;
}

/* ===================================================
    Add custom model functions here
   =================================================== */

function _get_item_id($id){
    $data = $this->db->get_where('store_item_sizes', array('id' => $id) )->result()[0];
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

// function get_item_id($update_id){
//     /* fetch the item id */
//     $item_id = null;
//     $query = $this->get_where($update_id);
//     foreach($query->result() as $row){
//         $item_id = $row->item_id;
//     }
//     return $item_id ;
// }    
// function get_item_title_id($id)
// {
//     $query = $this->db->get_where('store_items', array('id' => $id) );
//     foreach ($query->result() as $row)
//     {
//          $title  = $row->item_title;
//          $small_img = $row->small_pic ? : null;
//      }
//     return array( $title, $small_img );
// }


/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */


}