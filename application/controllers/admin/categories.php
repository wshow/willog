<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-17 22:17
 * File:    categories.php
 */
require_once('Admin_Controller.php');

class Categories extends Admin_Controller {
    public function index()
    {
        $page = $this->input->get('page');
        $this->data['users'] = $this->m_db->get_list(array('table'=>'terms','page'=>$page,'where'=>array('taxonomy'=>1)));

        $this->admin_view(array('folder'=>'terms','page'=>'categories','index'=>15));
    }
}
/* End of file categories.php */
/* Location: ./application/controllers/admin/categories.php */