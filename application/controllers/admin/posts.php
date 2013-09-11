<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-04 23:11
 * File:    posts.php
 */

require_once('Admin_Controller.php');

class Posts extends Admin_Controller
{
    public function index($page = 1)
    {
        if(!is_numeric($page)) show_404();
        $post = array(
            'type' => 'post'
        );
        $this->data['posts'] = $this->m_db->get_list(array('table'=>'posts','where'=>$post,'page'=>$page));
        $this->paginators->config(array(
            'base_url' => base_url('/admin/posts/index'),
            'total_rows' => $this->data['posts']['data']['count'],
            'uri_segment' => 4
        ));
        $this->admin_view(array('folder'=>'posts','page'=>'posts','index'=>11));
    }

    public function add()
    {
        $this->load->model('m_terms');
        $terms = $this->m_terms->filter('category');
        $this->data['categories'] = $this->m_terms->create_checkbox($terms,$this->get_lang());

        $this->admin_view(array('folder'=>'posts','page'=>'post_add','index'=>11));
    }

    public function edit($id = 0)
    {
        $this->data['post'] = $this->m_db->get(array('table'=>'posts','id'=>$id,'type'=>'post'));
        if(empty($this->data['post']))
            show_404();

        $this->admin_view(array('folder'=>'posts','page'=>'post_edit','index'=>11));
    }

    public function action($action = false,$id = 0)
    {
        $post = $this->input->post('p');
        $post['type'] = 'post';
        $this->load->model('m_posts');
        if($action=='add'){
            $result = $this->m_posts->insert($post);
        }
        else if($action=='edit')
        {
            $result = $this->m_posts->update($post);
        }
        else if($action=='del')
        {
            $result = $this->m_db->delete(array('table'=>'posts','type'=>'post','id'=>$id));
        }
        if(is_ajax())
            json_result($result);
        redirect(base_url('admin/posts'));
    }

    public function slug($slug = false)
    {
        //if(is_ajax())
        {
            $this->load->model('m_posts');
            $result = $this->m_posts->check_slug($slug);
            json_result($result);
        }
    }
}
/* End of file posts.php */
/* Location: ./application/controllers/admin/posts.php */