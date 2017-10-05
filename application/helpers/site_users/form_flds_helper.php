<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* site_user.php */

if ( ! function_exists('isValid_username'))
{
  function isValid_username($str) 
  {
      $ci =& get_instance();
      $ci->load->module('site_security');         

      $error_msg = "You did not enter a correct username and/or password.";

      $col1 = 'username';
      $value1 = $str;
      $col2 = 'email';
      $value2 = $str;
      $query = $ci->cntlr_name->get_with_double_condition($col1, $value1, $col2, $value2);    
      $num_rows = $query->num_rows();

      if ($num_rows<1) {
          $ci->form_validation->set_message('username_check', $error_msg);
          return FALSE;        
      }

      foreach($query->result() as $row) {
          $pword_on_table = $row->password;
      }

      $pword = $ci->input->post('pword', TRUE);
      $result = $ci->site_security->_verify_hash($pword, $pword_on_table);

      if ($result==TRUE) {
          return TRUE;
      } else {
         $ci->form_validation->set_message('username_check', $error_msg);
         return FALSE;         
      }
  }
}// end


if ( ! function_exists('get_fields'))
{
  function get_fields( )
  {

      $site_user_rules = array(
            array(
              'field' => 'username',
              'label' => 'Username',
              'rules' => 'required|max_length[200]|callback_username',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text'
              // 'input_options' => '0'
            ),
            array(
              'field' => 'email',
              'label' => 'Email',
              'rules' => 'required|valid_email|max_length[200]|callback_email',
              'icon'  => 'envelope',
              'placeholder'=>'',
              'input_type' =>'text'
              // 'input_options' => '0'
            ),
            array(
              'field' => 'first_name',
              'label' => 'First Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),
            array(
              'field' => 'last_name',
              'label' => 'Last Name',
              'rules' =>'required|min_length[3]|max_length[40]',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),
            array(
              'field' => 'middle_name',
              'label' => 'Middle Name',
              'rules' =>'',
              'icon'  => 'user',
              'placeholder'=>'',
              'input_type' => 'text', // text, password or drop_down_sel
              // 'input_options' => '0',
            ),
            array(
              'field' => 'phone',
              'label' => 'Phone',
              'rules' =>'',
              'icon'  => 'earphone',
              'placeholder'=>'(201) 999-9999',
              // 'input_value' => $display_value ? $results->phone : '',              
              'input_type' =>'text',
              'input_options'=>'0',
            ),
            array(
              'field' => 'cell_phone',
              'label' => 'Cell Phone',
              'rules' =>'',
              'icon'  => 'phone',
              'placeholder'=>'(201) 999-9999',
              // 'input_value' => $display_value ? $results->cell_phone : '',
              'input_type' =>'text',
              'input_options' => '0',          
            )
      );
            
 	  return $site_user_rules;

  }// get_fields

 
} // endif