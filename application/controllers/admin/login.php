<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-07-26 19:22
 * File:    login.php
 */
require_once('Admin_Controller.php');

class Login extends Admin_Controller {

    public function index()
    {
        //echo $this->get_lang();
        $this->lang->load('admin_login',$this->get_lang());
        $this->data['title'] =  $this->lang->line('title');

        $this->load->view('login',$this->data);
    }
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */