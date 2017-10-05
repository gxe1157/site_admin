<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{


function __construct() {
    parent::__construct();
}



/* ===============================================
    Added By Evelio Velez 04-28-2017
   =============================================== */

function get_login_byid($user_id)
{
    $this->db->select('*');
    $this->db->from('user_login');
    $this->db->join('user_main', 'user_main.id = user_login.id');
    $this->db->where("user_login.id = '".$user_id."'" );    
    $query = $this->db->get();
    return $query;

}   

function get_view_data_custom($col, $value, $table, $orderby)
{
    $this->db->where($col, $value);
    $this->db->order_by($orderby);        
    $query=$this->db->get($table);
    return $query;
}


function _parse_db($query, $use_fields)
{
    $data  = array();        
    foreach($query->result() as $row){
        foreach( $row as $key => $value ){
            if ( in_array($key, $use_fields) ) {
                $data[$key] = $value;            
            }    
        }    
    }
    return $data;
}

function _fetch_data_from_db($update_id, $use_fields)
{
    $data  = array();    
    $query = $this->get_where($update_id);
    $data  = $this->_parse_db($query, $use_fields);
    return $data;    
}

function _fetch_data_from_post($use_fields)
{
    $data  = array();
    $table = $this->get_table();    
    $mysql_query = "show columns FROM ".$table;
    $query = $this->_custom_query($mysql_query);

    foreach($query->result() as $row){
        $column_name = $row->Field;
        if($column_name != "id") {
            if ( in_array($column_name, $use_fields) ) {
                $data[$column_name] = $this->input->post( $column_name, TRUE);
            }    
        }
    }
    
    return $data;
}

function _get_insert_id(){
   /* get record id number after insert completed */ 
   $last_id =  $this->db->query('SELECT LAST_INSERT_ID() as last_id')->row()->last_id;
   return $last_id;
}


/* ===============================================
    Below is Perfect Model From David Connelly
   =============================================== */

// function get_table() {
//     $table = "tablename";
//     return $table;
// }

function get($order_by){
    $table = $this->get_table();
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $table = $this->get_table();
    $this->db->limit($limit, $offset);
    $this->db->order_by($order_by);
    $query=$this->db->get($table);
    return $query;
}

function get_where($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $query=$this->db->get($table);
    return $query;
}

function get_where_custom($col, $value, $orderby) {
    $table = $this->get_table();
    $this->db->where($col, $value);
    $this->db->order_by($orderby);        
    $query=$this->db->get($table);
    return $query;
}

function _insert($data){
    $table = $this->get_table();
    $this->db->insert($table, $data);
}

function _update($id, $data){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->update($table, $data);
}

function _delete($id){
    $table = $this->get_table();
    $this->db->where('id', $id);
    $this->db->delete($table);
}

function count_where($column, $value) {
    $table = $this->get_table();
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function count_all() {
    $table = $this->get_table();
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
}

function get_max() {
    $table = $this->get_table();
    $this->db->select_max('id');
    $query = $this->db->get($table);
    $row=$query->row();
    $id=$row->id;
    return $id;
}

function _custom_query($mysql_query) {
    $query = $this->db->query($mysql_query);
    return $query;
}

}