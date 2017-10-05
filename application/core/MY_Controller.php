<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{

function __construct()
{
  parent::__construct();

  $this->load->module('site_security');  
  $this->load->library('form_validation');
  $this->form_validation->CI =& $this;

  /* ===============================================================
    model name is assigned from $this->mdl_name to  'cntlr_name' which is a constant
   =============================================================== */
   if( $this->mdl_name != 'mdl_' ) $this->load->model( $this->mdl_name, 'cntlr_name');

}


//"$sql  = \'SELECT * FROM `msite_categories` WHERE parent_cat_id = (SELECT `id` FROM `msite_categories` WHERE parent_cat_id = 0)"';


/* ===============================================
   Add DRY funtions  // Added By Evelio Velez 04-2017
   =============================================== */

function send_mail( $email, $type, $mess_ecode)
{
    if( ENVIRONMENT != 'production' ) return false;

    $results_set = $this->cntlr_name->get_view_data_custom('type', $type, 'site_admin_emails', null)->result();
    
    $admin_email = $results_set[0]->admin_email;
    $from        = $results_set[0]->from;
    $subject     = $results_set[0]->subject;
    $message     = $results_set[0]->body;

    $domain  = base_url();
    $message = sprintf($message, $domain, $mess_ecode);

    $this->load->library('email');
    $this->email->from( $from, $user_id);
    $this->email->to($email);
    $this->email->cc($admin_email);

    $this->email->subject($subject);
    $this->email->message($message);

    $this->email->send();

    // if ( ! $this->email->send()) {
    //         // Generate log error
    // }
}

function _security_check()
{
  //  $this->load->library('session');
  //  $this->load->module('site_security');
}

function _numeric_check($update_id)
{
    if( !is_numeric($update_id) )
        redirect('site_security/not_allowed');
}

function _set_flash_msg($flash_msg)
{
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
}

function _set_flash_danger_msg($flash_msg)
{
    $value = '<div style="border: 5px solid #578EBE; padding:10px; background-color: #f7d1b2; color: #000; font-size: 1.25em;">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
}

function _render_view(  $arg, $data )
{
    $data['flash'] = $this->session->flashdata('item');
    $this->load->module('templates');
    $arg == 'public_bootstrap' ? $this->templates->public_bootstrap($data) : $this->templates->admin($data);
}


function _get_column_names( $key_value )  // we will use for $key_value only "field" or "label"
{
    foreach ($this->column_rules as $key => $value) {
        if( $key_value == 'field' ) {
            $data[] = $this->column_rules[$key][$key_value];
        } else {
            $field  = $this->column_rules[$key]['field'];
            $data[$field] = $this->column_rules[$key]['label'];
        }
    }
    //checkArray($data, 1);
    return $data;
}


function fetch_data_from_post()
{
    $field_names = $this->_get_column_names('field');
    $data = $this->cntlr_name->_fetch_data_from_post($field_names);

    return $data;
}

function fetch_data_from_db($update_id)
{
    $field_names = $this->_get_column_names('field');
    $data = $this->cntlr_name->_fetch_data_from_db($update_id, $field_names);

    // checkArray($data,0);
    if( !isset($data) ) {
        // No records found send to manage item page
        redirect( 'store_items/manage');
    }
    return $data;
}

function _get_cat_title( $update_id )
{
    $data = $this->fetch_data_from_db( $update_id );
    $cat_title = $data['cat_title'];
    return $cat_title;
}

function _get_first_record( $q, $id)  // This controller does not need a model
{
        $result_set = $q->result();
        return  $result_set[0]->$id;
}


/* ===============================================
   Below is Perfect Controller From David Connelly
   =============================================== */

function get($order_by)
{
    $query = $this->cntlr_name->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by)
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $query = $this->cntlr_name->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable! '.$id);
    }

    $query = $this->cntlr_name->get_where($id);
    return $query;
}

function get_where_custom($col, $value, $order_by = null)
{
    $query = $this->cntlr_name->get_where_custom($col, $value, $order_by);
    return $query;
}


function _insert($data)
{
    $this->cntlr_name->_insert($data);
    return $this->cntlr_name->_get_insert_id(); // added 07-22-17 Evelio   
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->cntlr_name->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->cntlr_name->_delete($id);
}

function count_where($column, $value)
{
    $count = $this->cntlr_name->count_where($column, $value);
    return $count;
}

function get_max()
{
    $max_id = $this->cntlr_name->get_max();
    return $max_id;
}

function _custom_query($mysql_query)
{
    $query = $this->cntlr_name->_custom_query($mysql_query);
    return $query;
}



}
