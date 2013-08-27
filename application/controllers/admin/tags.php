<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-21 20:07
 * File:    tags.php
 */
require_once('Admin_Controller.php');

class Tags extends Admin_Controller
{
    public function index($page = 1)
    {
        if(!is_numeric($page)) show_404();
        $tag = array(
            'taxonomy' => 'tag'
        );
        $this->data['tags'] = $this->m_db->get_list(array('table'=>'terms','where'=>$tag,'page'=>$page));
        $this->paginators->config(array(
            'base_url' => base_url('/admin/tags/index'),
            'total_rows' => $this->data['tags']['data']['count'],
            'uri_segment' => 4
        ));
        $this->admin_view(array('folder'=>'terms','page'=>'tags','index'=>17));
    }

    public function edit($id = 0)
    {
        $this->data['tag'] = $this->m_db->get(array('table'=>'terms','id'=>$id,'taxonomy'=>'tag'));
        if(empty($this->data['tag']))
            show_404();

        $this->admin_view(array('folder'=>'terms','page'=>'tag_edit','index'=>17));
    }

    public function action($action = false,$id = 0)
    {
        $term = $this->input->post('t');
        $this->load->model('m_terms');
        $term['taxonomy'] = 'tag';
        if($action=='add'){
            $result = $this->m_terms->insert($term);
        }
        else if($action=='edit')
        {
            $result = $this->m_terms->update($term);
        }
        else if($action=='del')
        {
            $result = $this->m_db->delete(array('table'=>'terms','taxonomy'=>'tag','id'=>$id));
        }
        if(is_ajax())
            json_result($result);
        redirect(base_url('admin/tags'));
    }
}
/* End of file tags.php */
/* Location: ./application/controllers/admin/tags.php */