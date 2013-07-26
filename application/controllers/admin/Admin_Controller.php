<?php
/**
 * willog
 * Author:  willin
 * Created: 2013-07-26 19:55
 * File:    MY_Admin_Controller.php
 */
class Admin_Controller extends CI_Controller{
    private  $site_lang = '';
    public $lan = '';

    public function __construct(){
        parent::__construct();
        $this->site_lang = $this->options->get_option('site_lang');
    }

    public  function get_lang(){
        return $this->site_lang;
    }


}