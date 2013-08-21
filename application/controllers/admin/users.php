<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-16 22:30
 * File:    users.php
 */
require_once('Admin_Controller.php');

class Users extends Admin_Controller {

    public function index($page=1)
    {
        if(!is_numeric($page)) show_404();
        $this->data['users'] = $this->m_db->get_list(array('table'=>'users','page'=>$page));
        $this->paginators->config(array(
            'base_url' => base_url('/admin/users/index'),
            'total_rows' => $this->data['users']['data']['count'],
            'uri_segment' => 4
        ));

        $this->admin_view(array('folder'=>'users','page'=>'users','index'=>81));
    }

    public function add()
    {
        $this->admin_view(array('folder'=>'users','page'=>'user_add','index'=>82));
    }

    public function edit($id = 0)
    {
        $this->data['user'] = $this->m_db->get(array('table'=>'users','id'=>$id));
        if(empty($this->data['user']))
            show_404();

        $this->admin_view(array('folder'=>'users','page'=>'user_edit','index'=>81));
    }

    public function action($action = false,$id = 0)
    {
        $user = $this->input->post('u');
        if($action=='add'){
            $result = $this->m_users->insert($user);
        }
        else if($action=='edit')
        {
            $result = $this->m_users->update($user);
        }
        else if($action=='del')
        {
            $result = $this->m_users->delete(array('id'=>$id));
        }
        if(is_ajax())
            json_result($result);
        redirect(base_url('admin/users'));
    }

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */