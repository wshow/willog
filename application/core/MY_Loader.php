<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-05 19:54
 * File:    MY_Loader.php
 */
class MY_Loader extends CI_Loader {

    public function __construct()
    {
        parent::__construct();
        $this->_ci_view_paths =  array( WILLOG.'themes/' => TRUE);//定义你自己的views路径

    }

    public function system_view($view, $vars = array(), $return = FALSE){
        $this->_ci_view_paths =  array( APPPATH.'views/' => TRUE);
        $this->view($view, $vars = array(), $return = FALSE);
    }
}