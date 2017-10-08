<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('login_init'))
{
	function login_init( ) {
	    $ci =& get_instance();
	    $ci->load->module('site_security');     
	    $userid = $ci->site_security->_get_user_id();	    
	    $userid = is_numeric( $userid ) ? $userid : 0; // This will return userid not a true or false

	    $login_data = $ci->cntlr_name->get_login_byid($userid)->result();

	    $default['status']= $userid > 0 ? 1 : 0;
		$default['admin_id'] = $userid;	    /* tis user is logged */
	    $default['admin_name']= $userid>0 ? $login_data[0]->username : '';
	    $default['avatar_admin']= $userid>0 ? $login_data[0]->avatar_name : '';
 	    $default['is_admin']= $userid>0 ? $login_data[0]->is_admin : '';
	    $default['page_title'] = "Admin Login";

	    return $default;
	}
}


if ( ! function_exists('checkArray'))
{
	function checkArray( $array = array(), $exit){
	    echo "<pre>";
	    print_r($array);
	    echo "</pre>";
	    if( empty($exit) ){
	        exit();  
	    }
	}
}

if ( ! function_exists('checkField'))
{
	function checkField( $fld = null, $exit){
	    echo "<h4>fld| ".$fld." |</h4>";
	    if( empty($exit) ){
	        exit();  
	    }
	}
}


if ( ! function_exists('quit'))
{
	function quit($output = null, $exit = null){
	    echo('<h3>Debug Position: '.$output.'</h3>');
	    if( empty($exit) ) exit();  
	}
}

if ( ! function_exists('base_dir'))
{
	function base_dir(){
    	$base_dir = explode('application', APPPATH);
    	return $base_dir[0];
	}
}


if ( ! function_exists('SQLformat_date'))
{
	function SQLformat_date($date){
	    $temp=$date[6].$date[7].$date[8].$date[9].'-'.$date[0].$date[1].'-'.$date[3].$date[4];
	    return $temp;
	}
}

if ( ! function_exists('format_date'))
{
	function format_date($date){
	    if(empty($date)) $date ="0000/00/00";
	    $temp=$date[5].$date[6].'/'.$date[8].$date[9].'/'.$date[0].$date[1].$date[2].$date[3];
	    return ($temp == '00/00/0000' || $temp == '//') ? null : $temp;
	}
}


if ( ! function_exists('convert_timestamp'))
{
	function convert_timestamp($timestamp, $format)	{ 
     
	     switch ($format) {
	         case 'full':
	         //FULL // Friday 18th of February 2011 at 10:00:00 AM       
	         $the_date = date('l jS \of F Y \a\t h:i:s A', $timestamp);
	         break;          
	         case 'cool':
	         //FULL // Friday 18th of February 2011          
	         $the_date = date('l jS \of F Y', $timestamp);
	         break;                  
	         case 'datepicker_us':
	         //DATEPICKER  // 2/18/11         
	         $the_date = date('m\/d\/Y', $timestamp); 
	         break;  
	     }
	     return $the_date;
	}
}

