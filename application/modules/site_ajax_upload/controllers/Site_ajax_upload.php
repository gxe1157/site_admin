<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Perfectcontroller to [Name]
class Site_ajax_upload extends MY_Controller
{

/* model name goes here */
var $mdl_name = 'Mdl_site_ajax_upload';
var $store_controller = 'site_ajax_upload';

var $column_rules = array(
    array('field' => '---', 'label' => '---', 'rules' => '---')        
);

// use like this.. in_array($key, $columns_not_allowed ) === false )
var  $columns_not_allowed = array( 'create_date' );

function __construct() {
    parent::__construct();

}


/* ===================================================
    Controller functions goes here. Put all DRY
    functions in applications/core/My_Controller.php
   =================================================== */

function _get_image_info($userid)
{
  /* Check userid account to verify passcode here */ 
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
          $img_uploaded = explode("_", $row->image);
          /* minimize image name conflicts by verifing userid attached to image name.*/
          if( $userid != $img_uploaded[0] ){ 
              die('.......... ERROR .............. prg: site_ajax_upload | '.$row->image);
              $users_images[ $role ] = array( $row->id, '');
          } else {
              $users_images[ $role ] = array( $row->id, $row->image);
          }
      }
    }
    return array($image_list, $users_images);    
}


function ajax_remove()
{
    // $this->_security_check();
    sleep(1);

    $id = $_POST['id'];  // image_id
    $query = $this->get_where_custom('id', $id);
    $results = $query->result();
    $file_name = $results[0]->image;
    $file_location = './upload/'.$file_name;
    $file_name = explode("_",$file_name);

    $this->_delete($id);

    /* get absolute path to file */
    if( file_exists( $file_location ) ) {
        unlink($file_location);
        $response = array(
          "position"  => $_POST['position'],
          "remove_name" => $file_name[1],
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


function ajax_upload_one()
{
    // $this->_security_check();
    sleep(1);
    $this->load->module('site_security');
    $userid = $this->site_security->_make_sure_logged_in();

    $config["upload_path"]   = './upload/';
    $config['allowed_types'] = 'jpeg|jpg|png|gif';
    $config['max_size']      = '2048';

    $this->load->library('upload', $config);
    $imagename = $_FILES['file']['name'];
    $config['file_name'] = $imagename; // set the name here

    $this->upload->initialize($config);

    if($this->upload->do_upload('file')) {
      $data = $this->upload->data();
      // $this->_update_avatar_data($imagename, $userid);          
      // echo 1;
    } else {
      // display errors 
      $data = '';
      $data = "<p>The filetype/size you are attempting to upload is not allowed. The max-size for files is ".$config['max_size']." kb and accepted file formats are ".$config['allowed_types'].".</p>";

    }
    echo json_encode($data);    
}


function _generate_thumbnail($file_name)
{
    $config['image_library'] = 'gd2';
    $config['source_image']  = './public/big_pic/'.$file_name;
    $config['new_image']     = './public/small_pic/'.$file_name;
    $config['create_thumb']  = FALSE;
    $config['maintain_ratio']= TRUE;
    $config['width']         = 200;
    $config['height']        = 200;

    $this->load->library('image_lib', $config);
    $this->image_lib->resize();
}

// function ajax_remove_avatar()
// {
//     // $this->_security_check();
//     $this->load->module('site_security');
//     $userid = $this->site_security->_make_sure_logged_in();
    
//     $imagename = 'annon_user.png';
//     $this->_update_avatar_data($imagename, $userid);

//     $data['file_name'] = $imagename;   
//     echo json_encode($data);    

// }

// function _update_avatar_data($imagename, $userid)
// {
//     /* get image name on file */ 
//     $default_avatar = 'annon_user.png';    
//     $mysql_query    = "SELECT avatar_name FROM `user_login` WHERE `id` =".$userid;
//     $result_set     = $this->model_name->_custom_query($mysql_query)->result();
//     $avatar_on_file = $result_set[0]->avatar_name;

//     if( $avatar_on_file != $default_avatar  &&  $avatar_on_file !='' ){
//         $file_location  = './upload/'.$avatar_on_file;  
//         if( file_exists( $file_location ) )
//             unlink($file_location);
//     }
    
//     /* Update database */
//     $mysql_query = "UPDATE `user_login` SET `avatar_name` = '".$imagename."' WHERE `user_login`.`id` = ".$userid;

//     $this->model_name->_custom_query($mysql_query);
// }


// function in_array($haystack, $needle)
// {
//    foreach($haystack as $first_key => $array) {
//       foreach( $array as $sec_key=>$value){
//         if( $needle == $value ){
//             return true;
//         }
//       }
//    }
//    return false;
// }

// function test()
// {

//   echo "<h1>test</h1>";

//   list( $image_list, $users_images ) = $this->_get_image_info(1); 

//   $isFound = $this->in_array($users_images, '1_Chrysanthemum.jpg' );

//   echo $isFound == true ? 'found dupes':' Nope..';

// }

function ajax_upload()
{
  // $this->_security_check();

  sleep(1);
  $this->load->module('site_security');
  $userid = $this->site_security->_make_sure_logged_in();

  list( $image_list, $users_images ) = $this->_get_image_info($userid); 

  $vector = $_FILES['file'];
  foreach($vector as $key1 => $value1) 
      foreach($value1 as $key2 => $value2) 
          $result[$key2][$key1] = $value2; 
  $uploaded_files = $result;

  if( count($uploaded_files) > 0) {
    // $output = '';
    $config["upload_path"]   = './upload/';
    $config['allowed_types'] = 'jpeg|jpg|png|gif';
    $config['max_size']      = '1024';

    $this->load->library('upload', $config);

    for($display_position = 0; $display_position<count($uploaded_files); $display_position++) {

      if( !empty($uploaded_files[$display_position]["name"]) ) {
        $_FILES["file"]["name"] = $uploaded_files[$display_position]["name"];
        $_FILES["file"]["type"] = $uploaded_files[$display_position]["type"];
        $_FILES["file"]["tmp_name"] = $uploaded_files[$display_position]["tmp_name"];
        $_FILES["file"]["error"] = $uploaded_files[$display_position]["error"];
        $_FILES["file"]["size"] = $uploaded_files[$display_position]["size"];

        $imagename = $userid.'_'.$uploaded_files[$display_position]["name"];
        $config['file_name'] = $imagename; // set the name here
        $this->upload->initialize($config);

        $isFound = $this->in_array($users_images, $imagename );
        if( $isFound ) {
            /* Duplicate found... Do Not Upload */
            $response[$display_position] = array(
              "error_mess"=> ''
            );

        } else {

              if($this->upload->do_upload('file')) {
                  /* pload is successful - update mySQL */
                  $data = $this->upload->data();

                  $row_data = array(  
                    'userid' => $userid,
                    'parent_cat' => $display_position+1,
                    'image' => $data['file_name'],
                    'path'  => $data['full_path'],
                    'size'  => $data['file_size'],
                    'width_height'=> $data['image_size_str'],
                    'create_date'=> time()  // timestamp for database
                  );

                  /* Insert data and get record id */
                  $update_id = $this->_insert($row_data);
                  $response[$display_position] = array(
                    "position"  => $display_position+1,
                    "update_id" => $update_id,                  
                    "file_name" => $data["client_name"],
                    "file_ext"  => $data["file_ext"],
                    "file_size" => $data["file_size"],
                    "image_type"=> $data["image_type"],
                    "image_size_str"=>$data["image_size_str"],
                    "error_mess"=> ''
                  );

              } else {
                  /* Upload has failed....*/
                  $data = '';
                  $data = "<p>The filetype/size you are attempting to upload is not allowed. The max-size for files is ".$config['max_size']." kb and accepted file formats are ".$config['allowed_types'].".</p>";

                  $response[$display_position] = array(
                    "file_name" => '',            
                    "position"  =>$display_position+1,
                    "error_mess"=> $data,
                  );

              }
            } // end if 
          } // end Duplicate
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
