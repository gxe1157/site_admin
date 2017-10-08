<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site_captcha extends MY_Controller
{
    /* model name goes here */
    var $mdl_name = 'mdl_site_captcha';
    var $main_controller = 'site_captcha';

    function __construct() {
        parent::__construct();

    }


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
  ==================================================== */

    function _create_captcha() {
        $this->load->helper('captcha');
        $vals = array(
                'word'          => '',
                'img_path'      => './captcha/',
                'img_url'       => base_url().'captcha/',
                'font_path'     => './system/fonts/texb.ttf',
                'img_width'     => 280,
                'img_height'    => 50,
                'expiration'    => 7200,
                'word_length'   => 6,
                'font_size'     => 24,
                'img_id'        => 'Imageid',
                'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

                // White background and border, black text and red grid
                'colors'        => array(
                        'background' => array(255, 255, 255),
                        'border' => array(255, 255, 255),
                        'text' => array(0, 0, 0),
                        'grid' => array(255, 40, 40)
                )
        );
        $cap = create_captcha($vals);
        $data = array(
                'captcha_time'  => $cap['time'],
                'ip_address'    => $this->input->ip_address(),
                'word'          => $cap['word']
        );

        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);
        // echo $cap['image'];
        // die('Debug Mode....................');

        return $cap['image'];
    }
 

/* ===============================================
    Call backs go here...
  =============================================== */
    function check_captcha($code) {
        /* First, delete old captchas  */
        $expiration = time() - 3600; // One hour limit
        $this->db->where('captcha_time < ', $expiration)
                ->delete('captcha');

        /* read directory and unlink expired captcha images */
        $dir = "./captcha/";
        $a = scandir($dir);
        foreach ($a as $key => $value) {
        //     # code...
            $time_value = substr($value, 0, -4);
            if( $time_value < $expiration  && strlen($time_value) >3 ) {
                $is_deleted = unlink($dir.$value);
                //if( $is_deleted ) echo "delete: ".$expiration." | ".$time_value."<br>";
            }
        }

        // Then see if a captcha exists:
        $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
        $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count == 0) {
            return FALSE;
        }
        return TRUE;
    }


/* ===============================================
    Notes
   =============================================== */
    // Reminder: Add this to controller on submit
    // $this->load->module('site_captcha');            
    // $captcha_value = $this->input->post('captcha', TRUE);        
    // $captcha_isValid = $this->site_captcha->check_captcha($captcha_value);  

/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
