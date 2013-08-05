<?php
/**
 * willog
 * Author:  willin
 * Created: 2013-07-26 19:55
 * File:    MY_Admin_Controller.php
 */
class Admin_Controller extends CI_Controller{
    private  $_site_lang = '';
    private  $_cur_lang = '';
    public $data;

    public function get_lang(){
        return $this->_cur_lang;
    }

    public function __construct(){
        parent::__construct();
        $this->_site_lang = $this->options->get('site_lang');
        if(! $this->_cur_lang = $this->session->userdata('lang')){
            $this->_cur_lang = $this->_site_lang;
            $this->session->set_userdata('lang',$this->_site_lang);
        }
        $this->data['site_name'] = $this->options->get('site_name',$this->get_lang());
    }
}