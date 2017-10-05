<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_store_cat_assign extends MY_Model
{

function __construct( ) {
    parent::__construct();
}

function get_table() {
	// table name goes here
    $table = "store_cat_assign";
    return $table;
}



/* ===================================================
    Add custom model functions here
   =================================================== */
// table store_cat_assign
function _get_assigned_id($id){
    $data = $this->db->get_where('store_cat_assign', array('id' => $id) )->result()[0];
    $item_id = $data->item_id;
    return $item_id ;
}


function _get_assigned_categories($col, $value, $orderby)
{
    $table = "store_cat_assign";
    $this->db->where($col, $value);
    $this->db->order_by($orderby);
    $query=$this->db->get($table);
    return $query;
}


// table store_items
function _get_item_title_byid($id)
{
    $data = $this->db->get_where('store_items', array('id' => $id) )->result()[0];
    $title  = $data->item_title;
    $small_img = $data->small_pic ? : null;
    return array( $title, $small_img );
}


// table store store_cat_categories
function _get_all_sub_cats_for_dropdown()
{
    $sub_categories = array();
    $mysql_query = "SELECT * FROM store_categories
                    where parent_cat_id != 0
                    ORDER BY parent_cat_id, cat_title";
    $query = $this->db->query($mysql_query);

    foreach ($query->result() as $row) {
       $parent_cat_title = $this->_get_cat_title($row->parent_cat_id);
       $sub_categories[$row->id] = $parent_cat_title." > ".$row->cat_title;
    }
    return $sub_categories;
}

function _get_parent_cat_title( $id )
{

    // checkField($id,0);
    $data = $this->_exec_get_title_query( $id );
    $cat_title = $data->cat_title;
    $parent_cat_id = $data->parent_cat_id;
    $parent_cat_title = $this->_get_cat_title($parent_cat_id);
    return array( $cat_title, $parent_cat_title);
}

function _get_cat_title( $id )
{
    $data = $this->_exec_get_title_query( $id );
    $cat_title = $data->cat_title;
    return $cat_title;
}

function _exec_get_title_query( $id )
{
    $table = "store_categories";
    $this->db->where('id', $id);
    $data=$this->db->get($table)->result()[0];
    return $data;
}


/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class
