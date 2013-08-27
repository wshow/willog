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


        $this->admin_view(array('page'=>'system','index'=>91));
    }
}
/* End of file system.php */
/* Location: ./application/controllers/admin/system.php */