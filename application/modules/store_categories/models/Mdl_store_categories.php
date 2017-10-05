<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_categories extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "store_categories";
    return $table;
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

/* ===================================================
    Add custom model functions here
   =================================================== */




/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class