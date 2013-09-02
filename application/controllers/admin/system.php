<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 21:30
 * File:    system.php
 */

require_once('Admin_Controller.php');

class System extends Admin_Controller {
    public function index()
    {
        $this->load->model('m_options');
        $this->data['options'] = $this->m_options->get();

        $this->admin_view(array('folder'=>'system','page'=>'system','index'=>91));
    }

    public function languages()
    {
        $this->load->helper('directory');
        $this->data['languages'] = directory_map('./application/language',1);
        $this->load->model('m_options');
        $this->data['options'] = $this->m_options->get();

        $this->admin_view(array('folder'=>'system','page'=>'languages','index'=>92));
    }
}
/* End of file system.php */
/* Location: ./application/controllers/admin/system.php */