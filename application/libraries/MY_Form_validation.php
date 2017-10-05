<?php
/** application/libraries/My_Form_validation **/

class My_Form_validation extends CI_Form_validation {
	public $CI;

public function is_unique($str, $field)
	{

		sscanf($field, '%[^.].%[^.]', $table, $field);

		$result_set = $this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0;
		if( $result_set === true ) {
			return true;
		} else {
			return false;			
		}

		/* Not working: $this->CI->db always reads false. */
		// return isset($this->CI->db)
		// 	? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0)
		// 	: FALSE;
	}

public function is_valid($str, $field)
	{

		sscanf($field, '%[^.].%[^.]', $table, $field);

		$result_set = $this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 1;
		if( $result_set === true ) {
			return true;
		} else {
			$error_msg = 'Email not found. Please try again.';
 			$this->CI->form_validation->set_message( 'is_valid', $error_msg);			
			return false;			
		}
	}



}


