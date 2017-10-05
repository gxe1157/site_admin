<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_default_module extends CI_Model
{

function __construct( ) {
parent::__construct();
}



/* ===================================================
    Add custom model functions here
   =================================================== */

function fetch_webpage($col, $value, $table)
{
    $this->db->where($col, $value);
    $query=$this->db->get($table);
    return $query;
}


function get_login_byid($user_id)
{
    $this->db->select('*');
    $this->db->from('user_login');
    $this->db->join('user_main', 'user_main.id = user_login.id');
    $this->db->where("user_login.id = '".$user_id."'" );    
    $query = $this->db->get();
    return $query;

}   

/* ===============================================
    David Connelly's work from mdl_perctmodel
    is in applications/core/My_Model.php which
    is extened here.
  =============================================== */




}// end of class