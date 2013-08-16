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

    public function index()
    {
        $page = $this->input->get('page');
        $this->data['users'] = $this->m_users->get_list(array('page'=>$page,'page_size'=>1));

        $this->admin_view(array('page'=>'users','index'=>81));
    }

    public function add()
    {
        $this->admin_view(array('page'=>'user_add','index'=>82));
    }

    public function edit()
    {
        $id = $this->input->get('id');
        $this->data['user'] = $this->m_users->get(array('id'=>$id));
        if(empty($this->data['user']))
            show_404();

        $this->admin_view(array('page'=>'user_edit','index'=>81));
    }

    public function action($action = false)
    {
        $user = $this->input->post('u');
        if($action=='add'){
            $result = $this->m_users->insert($user);
        }
        else if($action=='edit')
        {
            var_dump($user);
            $result = $this->m_users->update($user);
        }
        else if($action=='del')
        {
            $user = $this->input->get_post('u');
            $result = $this->m_users->delete($user);
        }
        var_dump($result);
        exit();
    }

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */