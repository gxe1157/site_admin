<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Users_upload extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'Mdl_users_upload';
var $store_controller = 'users_upload';

var $column_rules = array(
        array('field' => '---', 'label' => '---', 'rules' => '---')        
);

//// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( 'create_date' );

function __construct() {
    parent::__construct();

}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   =================================================== */

 function index()
 {

    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();

    $userid = 1;
    // security check

    $image_list = array();
    $users_images = array();

    list( $image_list, $users_images ) = $this->_get_image_info($userid);
    $data['image_list'] = $image_list;
    $data['users_images'] = $users_images;    

    $data['menu_level'] = 1;
    $data['custom_jscript'] = 'upload-image';
    $data['page_url'] = 'image_upload';
    $data['page_title'] = 'Page not found';
    $data['image_repro'] = '';
    $data['left_side_nav'] = false;
    $data['view_module'] = 'users_upload';
    $data['title'] = "Upload Image using Ajax JQuery in CodeIgniter";

    $this->load->module('templates');
    $this->templates->public_main($data);
}

function _get_image_info($userid)
{
    $image_list = array();
    $users_images = array();

    /* Get image categories */
    $query = $this->get_where_custom('parent_cat', 0);
    foreach($query->result() as $row){
        $image_list[$row->id] = $row->role;
    }
//echo "image_list: ".count($image_list);

    if( count($image_list) > 0 )  {
      /* assign images to categories */
      $query = $this->get_where_custom('userid', $userid);
      foreach($query->result() as $row){
          $role = $image_list[$row->parent_cat]; 
          $users_images[ $role ] = array( $row->id, $row->image);
      }
    }
    return array($image_list, $users_images);    
}


function ajax_remove()
{
    // $this->_security_check();
    sleep(1);

    $id = $_POST['id'];
    $query = $this->get_where_custom('id', $id);
    $results = $query->result();
    $file_name = $results[0]->image;

    $file_location = './upload/'.$file_name;

    $this->_delete($id);

    /* get absolute path to file */
    if( file_exists( $file_location ) ) {
        unlink($file_location);
        $response = array(
          "position"  => $_POST['position'],
          "remove_name" => $file_name,
          "error_mess" => ''          
        );
    } else {
        $response = array(
          "position"  => $_POST['position'],
          "remove_name" => $file_location,
          "error_mess" => 'We can not remove the file at this time... Try again later... '
        );
    }      

    echo json_encode($response);
}


function ajax_upload()
{
  // $this->_security_check();
  sleep(1);

$userid = 1;

  list( $image_list, $users_images ) = $this->_get_image_info($userid);  
  $vector = $_FILES['file'];
  foreach($vector as $key1 => $value1) 
      foreach($value1 as $key2 => $value2) 
          $result[$key2][$key1] = $value2; 

  $uploaded_files['file'] = $result;

  if( count($uploaded_files) > 0) {

    $output = '';
    $config["upload_path"]   = './upload/';
    $config['allowed_types'] = 'jpeg|jpg|png|gif';
    $config['max_size']      = '1024';

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    for($parent_cat_id = 0; $parent_cat_id<count($uploaded_files['file']); $parent_cat_id++) {

      if( !empty($uploaded_files['file'][$parent_cat_id]["name"]) ) {
        $_FILES["file"]["name"] = $uploaded_files['file'][$parent_cat_id]["name"];
        $_FILES["file"]["type"] = $uploaded_files["file"][$parent_cat_id]["type"];
        $_FILES["file"]["tmp_name"] = $uploaded_files["file"][$parent_cat_id]["tmp_name"];
        $_FILES["file"]["error"] = $uploaded_files["file"][$parent_cat_id]["error"];
        $_FILES["file"]["size"] = $uploaded_files["file"][$parent_cat_id]["size"];

        if($this->upload->do_upload('file')) {
            $data = $this->upload->data();

            $file_name =  $_FILES["file"]["name"];
            if( in_array( $file_name, $users_images, true) ) {
                /* Duplicate found... do Not Update */
                $response[$parent_cat_id] = array(
                  "file_name" => '',            
                  "position"  =>$parent_cat_id+1,
                  "error_mess"=> 'This file has already been upload...'
                );

            } else {
                //insert a new image
                $row_data = array(  
                  'userid' => $userid,
                  'parent_cat' => $parent_cat_id+1,
                  'image' => $data['file_name'],
                  'path' => $data['full_path'],
                  'size' => $data['file_size'],
                  'width_height' => $data['image_size_str'],
                  'create_date' => time()  // timestamp for database
                );

                $update_id = $this->_insert($row_data);
                //$update_id = $this->_get_insert_id();

                $response[$parent_cat_id] = array(
                  "position"  => $parent_cat_id+1,
                  "update_id" => $update_id,                  
                  "file_name" => $data["file_name"],
                  "file_ext"  => $data["file_ext"],
                  "file_size" => $data["file_size"],
                  "image_type"=> $data["image_type"],
                  "image_size_str"=>$data["image_size_str"],
                  "error_mess"=> ''
                );
            }    

        } else {
          // display errors 
          $data = '';
          $data = "<p>The filetype/size you are attempting to upload is not allowed. The max-size for files is ".$config['max_size']." kb and accepted file formats are ".$config['allowed_types'].".</p>";

          $response[$parent_cat_id] = array(
            "file_name" => '',            
            "position"  =>$parent_cat_id+1,
            "error_mess"=> $data,
          );

        }
      } // end if 
    } // end foreach
    echo json_encode($response);
  }
}
 





















/* ===============================================
    Call backs go here...
  =============================================== */


/* ===============================================
    David Connelly's work from perfectcontroller
    is in applications/core/My_Controller.php which
    is extened here.
  =============================================== */


} // End class Controller
