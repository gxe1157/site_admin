<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MX_Controller
{

public $default = [];


function __construct()
{
    parent::__construct();


}


function admin( $data = array() )
{

    if( !isset( $data['view_module'] ) )
        $data['view_module']= $this->uri->segment(1);
    
    $this->load->view('admin/admin', $data);

}


function public_main( $data )
{
    /* -----------------------------------------------------------------------------*/
    $menu_level = isset($data['menu_level']) ? $data['menu_level'] : 0;
    $mysql_query = "SELECT * FROM main_menu 
                    WHERE parentid = 0 And level = $menu_level
                    ORDER BY parentid, priority";

    $query = $this->db->query($mysql_query);
    foreach ($query->result() as $row) {
       $sub_nav_titles =  $this->_get_sub_cat($row->id);
       $parent_titles[$row->title] = count($sub_nav_titles)>0 ? $sub_nav_titles : $row->link;
    }
 
   if( empty($parent_titles) ) return;

    /* use for SEO purposes */
        $this->load->module('site_settings');
        $items_segments = ""; //$this->site_settings->_get_items_segments();
        /* get nav data */
        $data['target_url_start'] = base_url().$items_segments;
        $data['parent_titles'] = $parent_titles;

    /* get images from directory` */
    $data['image_repro'] = isset($data['image_repro']) ? $data['image_repro'] : null;
    $data['bm_pages']    = $data['image_repro'] == 'accept' ?
                           image_pagination( $data['imgDir'] ) : null;

    $data['title']       = $data['page_title'];
    $data['contents']    = $data['page_url']  ? :'Main';
    $data['menu_level']  = $menu_level;

    if( !isset($data['view_module']) ){
        $data['view_module']= $this->uri->segment(2) =='' ?
                         'partials' : $this->uri->segment(1);
    }

    $this->load->view('public_main/html_master_view', $data);
}

function _get_sub_cat($parentid)
{
    $sql  = "SELECT * FROM main_menu where parentid = $parentid ORDER BY priority";
    $sub_nav_titles = $this->db->query($sql)->result();
    return $sub_nav_titles;
}

function _draw_breadcrumbs($data)
{
    // NOTE: template, current_page_title, breadcrumbs_array are needed
    if( $data['breadcrumbs_array'] )
        $this->load->view('public_bootstrap/breadcrumbs_public_bootstrap', $data);
}

} // end Templates
