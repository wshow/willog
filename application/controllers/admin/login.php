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

        $this->load->system_view('1');
    }
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */