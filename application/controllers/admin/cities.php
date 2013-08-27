<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 16:52
 * File:    cities.php
 */

require_once('Admin_Controller.php');

class Cities extends Admin_Controller {
    public function index()
    {
        $this->load->model('m_terms');
        $terms = $this->m_terms->filter('city');

        $this->data['cities'] = $this->m_terms->create_html($terms,$this->get_lang(),'table');
        $this->data['options'] = $this->m_terms->create_html($terms,$this->get_lang(),'option');

        $this->admin_view(array('folder'=>'terms','page'=>'cities','index'=>16));
    }

    public function edit($id = 0)
    {
        $this->data['city'] = $this->m_db->get(array('table'=>'terms','id'=>$id,'taxonomy'=>'city'));
        if(empty($this->data['city']))
            show_404();
        $this->load->model('m_terms');
        $terms = $this->m_terms->filter('city');
        $this->data['options'] = $this->m_terms->create_html($terms,$this->get_lang(),'option',0,$this->data['city']);

        $this->admin_view(array('folder'=>'terms','page'=>'city_edit','index'=>16));
    }

    public function action($action = false,$id = 0)
    {
        $term = $this->input->post('t');
        $this->load->model('m_terms');
        $term['taxonomy'] = 'city';
        if($action=='add'){
            $result = $this->m_terms->insert($term);
        }
        else if($action=='edit')
        {
            $result = $this->m_terms->update($term);
        }
        else if($action=='del')
        {
            $result = $this->m_db->delete(array('table'=>'terms','taxonomy'=>'city','id'=>$id));
        }
        if(is_ajax())
            json_result($result);
        redirect(base_url('admin/cities'));
    }
}
/* End of file cities.php */
/* Location: ./application/controllers/admin/cities.php */