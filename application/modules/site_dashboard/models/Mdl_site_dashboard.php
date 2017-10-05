<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[Name]
class Mdl_site_dashboard extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "user_login";
    return $table;
}



/* ===================================================
    Add custom model functions here
   =================================================== */

function get_with_double_condition($col1, $value1, $col2, $value2) {
    $table = $this->get_table();
    // $table = 'user_login';
    $this->db->where($col1, $value1);
    $this->db->or_where($col2, $value2);
    $query=$this->db->get($table);
    return $query;
}



/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class