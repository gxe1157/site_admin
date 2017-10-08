<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_users extends MY_Controller 
{

/* model name goes here */
public $mdl_name = 'Mdl_site_users';
public $main_controller = 'site_users';

public $column_rules = [];
public $column_pword_rules  = array(
        array('field' => 'password', 'label' => 'Password',
              'rules' => 'required|min_length[6]|max_length[35]'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password',
              'rules' => 'required|matches[password]')
);

// used like this.. in_array($key, $columns_not_allowed ) === false )
public $columns_not_allowed = array( 'create_date' );
public $default = array();

function __construct() {
    parent::__construct();

    /* is user logged in */
    $this->default = login_init();    

    $this->load->helper('site_users/form_flds_helper');
    $this->column_rules = get_fields();

    /* get user data */
    $update_id = $this->uri->segment(3);
    $results_set = $this->model_name->get_view_data_custom('id', $update_id,'user_login', null)->result();

    $this->default['page_nav']   = "Members";     
    $this->default['username'] = count($results_set) > 0 ? $results_set[0]->username : '';
    $this->default['avatar_name'] = count($results_set) > 0 ? 
    empty($results_set[0]->avatar_name) ? 'annon_user.png' : $results_set[0]->avatar_name : 'annon_user.png';

    /* user status */
    $this->default['user_status'] = count($results_set) > 0 ? $results_set[0]->status : '';   
    $this->default['user_is_delete'] = count($results_set) > 0 ? $results_set[0]->is_delete : 0;        

    /* page settings */
    $this->default['headline']    = !is_numeric($update_id) ? "Manage Users" : "Update User Details";
    $this->default['page_header'] = !is_numeric($update_id) ? "Add New User" : "Update User Details";
    $this->default['add_button']  = "Add New User";
    $this->default['flash'] = $this->session->flashdata('item');
}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   ==================================================== */

// 
function manage()
{

    $data['columns'] = $this->model_name->get_login_data();

    $data['custom_jscript'] = [ 'public/js/datatables.min',
                                'public/js/site_datatable_loader',
                                'public/js/format_flds'];

    $data['page_url'] = "manage";
    $data['view_module'] = 'site_users';
    $data['title'] = "Manage User Accounts";

    $this->default['page_title'] = "Manage User Accounts";
    $data['default'] =  $this->default;  

    $this->load->module('templates');
    $this->templates->admin($data);        
}

// 
function create()
{

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if( $submit == "Cancel" || $submit == "Finished") {
        redirect($this->main_controller.'/manage');
    }

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_rules );

        if($this->form_validation->run() == TRUE) {
            $data = $this->fetch_data_from_post();

            if(is_numeric($update_id)){
                /* update user_main */
                $this->_update($update_id, $data);
    
                /* update user_login */
                $user_login['email']    = $this->input->post( 'email', TRUE);
                $user_login['username'] = $this->input->post( 'username', TRUE);
                $this->model_name->update_data( 'user_login', $user_login, $update_id );  

                $this->_set_flash_msg("The user details were sucessfully updated.");
            } else {
                /* insert new login */
                $random_str = $this->site_security->generate_random_string(4);
                $new_username =
                   substr($data['first_name'],0,1).$data['last_name'].'-'.$random_str;

                $user_login['is_admin']    = 0;
                $user_login['admin_id']    = $this->default['admin_id'];
                $user_login['status']      = 1;
                $user_login['create_date'] = time();
                $user_login['username']    = $new_username;
                $user_login['email']       = $this->input->post( 'email', TRUE);
                $user_login['password']    = $this->site_security->_hash_string('Smokey{2012}');
                $login_id = $this->model_name->insert_data( 'user_login', $user_login );

                /* insert a new user */
                $data['user_id'] = $login_id;
                $update_id = $this->model_name->insert_data( 'user_main', $data );                 

                $this->_set_flash_msg("The user was sucessfully added.");

                if( $login_id == $update_id) {                    
                  /* send possible error report to email */
                 //send_mail( 'gxe1157@gmail.com', 'mysql_problem', null);
                }                 
            }
            redirect($this->main_controller.'/create/'.$update_id);
        }
    }

    if( ( is_numeric($update_id) ) && ($submit != "Submit") ) {
        $data['columns'] = $this->fetch_data_from_db($update_id);
    } else {
        $data['columns'] = $this->fetch_data_from_post();
    }

    $data['columns_not_allowed'] = $this->columns_not_allowed;
    $data['labels'] = $this->_get_column_names('label');
    
    $data['update_id'] = $update_id;    

    $data['custom_jscript'] = [ 'sb-admin/js/jquery.cleditor.min',
                                'public/js/format_flds',
                                'public/js/model_js',                                  
                                'public/js/site_user_details'
                                ];    
    $data['page_url'] = "create";
    $data['view_module'] = 'site_users';
    $data['title'] = "Update User Details";

    $this->default['page_title'] = 'Update User Details';
    $data['default'] =  $this->default;  

    $this->load->module('templates');
    $this->templates->admin($data);        

}

// 
function update_password()
{

    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if( !is_numeric($update_id) ){
        redirect( $this->main_controller.'/manage');
    } elseif( $submit == "Cancel" ) {
        redirect( $this->main_controller.'/create/'.$update_id);
    } 

    if( $submit == "Submit" ) {
        // process changes
        $this->load->library('form_validation');
        $this->form_validation->set_rules( $this->column_pword_rules );

        if($this->form_validation->run() == TRUE) {
            $password = $this->input->post('password', TRUE);
            $this->load->module('site_security');
            $table_data = ['password' => $this->site_security->_hash_string($password)];

            //update the account details
            $this->model_name->update_data( 'user_login', $table_data, $update_id );
            $this->_set_flash_msg("The password was sucessfully updated.");
            redirect( $this->main_controller.'/create/'.$update_id);
        }
    }

    $data['columns']  = $this->fetch_data_from_post();    
    $data['page_url'] = "update_password";
    $data['update_id']= $update_id;

    $data['custom_jscript'] = [];    
    $data['page_url'] = "update_password";
    $data['view_module'] = 'site_users';
    $data['title'] = "Update Password";

    $this->default['page_title'] = 'Update Password';
    $data['default'] =  $this->default;  

    $this->load->module('templates');
    $this->templates->admin($data);        


}

// 
function change_account_status( $update_id, $status )
{
    /* unsuspend = 1, suspend = 2 */
    $this->_numeric_check($update_id);    
    $this->_security_check();    

    $table_data = ['status' => $status];
    $this->model_name->update_data( 'user_login', $table_data, $update_id );  
    if( $status == 1)
        $this->_set_flash_msg("The user account was sucessfully re-activated");

    redirect( $this->main_controller.'/create/'.$update_id);
}

// 
function delete( $update_id, $username )
{
    $this->_numeric_check($update_id);    
    $this->_security_check();    
    $this->_process_delete($update_id);
    $this->_set_flash_msg("The user account ".$username.", was sucessfully deleted");
    redirect( $this->main_controller.'/manage');
}

// 
function _process_delete( $update_id )
{
    /* delete related table */

    /* remove the images */
    // if(file_exists($big_pic_path)) {
    //     unlink($big_pic_path);
    // } 

    /* delete account */
    // $this->_delete( $update_id );
    $table_data = [ 'is_delete' => time() ];
    $this->model_name->update_data( 'user_login', $table_data, $update_id );  
    $this->model_name->update_data( 'user_main', $table_data, $update_id );  

}

/* ===============================================
    Call backs go here...
  =============================================== */
// 
  function email($str) {
      $mysql_query = "select * from user_login where email='$str'";

      $update_id = $this->uri->segment(3);
      if(is_numeric($update_id)) {
          // this is an update
          $mysql_query .= " and id!='$update_id'";
      }

      $query = $this->_custom_query($mysql_query);
      $num_rows = $query->num_rows();

      if( $num_rows > 0 ){
          $this->form_validation->set_message('email', 'The email selected is not available.');
          return FALSE;
      } else {
          return TRUE;
      }

  }

// 
  function username($str) {
      $mysql_query = "select * from user_login where username='$str'";

      $update_id = $this->uri->segment(3);
      if(is_numeric($update_id)) {
          // this is an update
          $mysql_query .= " and id!='$update_id'";
      }

      $query = $this->_custom_query($mysql_query);
      $num_rows = $query->num_rows();

      if( $num_rows > 0 ){
          $this->form_validation->set_message('username', 'The username selected is not available.');
          return FALSE;
      } else {
          return TRUE;
      }

  }



/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
