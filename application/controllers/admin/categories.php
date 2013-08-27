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
        $this->load->model('m_terms');
        $terms = $this->m_terms->filter('category');

        $this->data['categories'] = $this->m_terms->create_html($terms,$this->get_lang(),'table');
        $this->data['options'] = $this->m_terms->create_html($terms,$this->get_lang(),'option');

        $this->admin_view(array('folder'=>'terms','page'=>'categories','index'=>15));
    }

    public function action($action = false,$id = 0)
    {
        $term = $this->input->post('t');
        $this->load->model('m_terms');
        $term['taxonomy'] = 'category';
        if($action=='add'){
            $result = $this->m_terms->insert($term);
        }
        else if($action=='edit')
        {
            $result = $this->m_terms->update($term);
        }
        else if($action=='del')
        {
            $result = $this->m_db->delete(array('table'=>'terms','id'=>$id));
        }
        if(is_ajax())
            json_result($result);
        redirect(base_url('admin/categories'));
    }
}
/* End of file categories.php */
/* Location: ./application/controllers/admin/categories.php */