<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_module extends MX_Controller
{


public $mdl_name = 'mdl_default_module';


function __construct()
{
    parent::__construct();
    $this->load->model( $this->mdl_name, 'cntlr_name');    

}


function index()
{

    /* Web Pages */
	$first_bit = trim($this->uri->segment(1) );
	$query = $this->cntlr_name->fetch_webpage('page_url', $first_bit, 'webpages');
	$num_rows = $query->num_rows();

	if($num_rows > 0) {
		//we have found content... load page
		foreach($query->result() as $row ){
			$data['status'] = $row->status;
			$data['left_side_nav'] = $row->left_side_nav == 'accept' ? false : true;
			if( $row->left_side_nav == 'accept' )  $data['menu_level'] = 1;

			$data['page_title'] = $row->page_title;
			$data['page_keywords'] = $row->page_keywords;
			$data['page_description'] = $row->page_description;
			$data['page_content'] = $row->page_content;

			switch ($data['status']) {
			    case "0":
					$data['page_url'] = $row->page_url;

			        $file_name = APPPATH.'modules/templates/views/public_main/partials/'.$data['page_url'].'.php';
					if( !file_exists( $file_name ) && !empty($data['page_url']) ){
						$data['page_url'] = 'site_404page';
						$this->load->module('site_settings');
						$data['page_content'] = $this->site_settings->_get_page_not_found_msg();
					}

			        break;

			    case "1":
					$data['page_url'] = 'site_404page';
			        // echo "inactive ".$data['page_url']." | ";
			        break;

			    case "2":
					$data['page_url'] = 'site_under_construction';
			        // echo "Under construction ".$data['page_url']." | ";
			        break;
			}
		}
	
		$this->load->module('templates');
		$this->templates->public_main($data);
	} else {
		$dashboard = true;
		if( $dashboard ) {
			/* is user logged in */
    		$default = login_init();    
 			$default['page_nav'] = "Default Page";
		    $data['view_module'] = 'site_dashboard';
		    $data['title'] = "Welcome";
		    $data['default'] =  $default;  

			$this->load->module('templates');
			$this->templates->admin($data);
			
		} else {
			$data['page_url'] = 'site_404page';
			$data['page_title'] = 'Page not found';
			$data['image_repro'] = '';
			$data['left_side_nav'] = false;
			$data['view_module'] = 'partials';

			// $this->load->module('site_settings');
			$data['page_content'] = '';// $this->site_settings->_get_page_not_found_msg();

			$this->load->module('templates');
			$this->templates->public_main($data);
		}
	}
} // index


} // End class Controller
