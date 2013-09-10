<?php
/**
 * willog
 * Author:  willin
 * Created: 2013-07-26 19:55
 * File:    MY_Admin_Controller.php
 */
class Admin_Controller extends CI_Controller{
    public $site_lang = '';
    private $_langs = '';
    private $_cur_lang = '';
    public $cur_user = array();
    public $data = array();

    public function get_lang(){
        return $this->_cur_lang;
    }

    public function get_langs()
    {
        return explode(',',$this->_langs);
    }

    public function __construct(){
        parent::__construct();
        $this->load->model('m_users');
        $this->cur_user = $this->m_users->get_session();
        $this->_site_lang = $this->options->get('site_lang');
        $this->_langs = $this->options->get('site_langs');
        if(! $this->_cur_lang = $this->session->userdata('lang')){
            $this->_cur_lang = $this->_site_lang;
            $this->session->set_userdata('lang',$this->_site_lang);
        }
        $this->data['site_name'] = $this->options->get('site_name',$this->get_lang());
        $this->data['langs'] = $this->get_langs();
        $this->data['sys_langs'] = $this->_get_sys_langs();
        $this->data['cur_lang'] = $this->get_lang();
        $this->data['cur_user'] = $this->cur_user;
    }

    /**
     * Check Login
     */
    public function _remap($method, $params=array()){
        $this->cur_user = $this->m_users->get_session();
        if($this->router->class!='login')
        {
            if(empty($this->cur_user))
                redirect(base_url('admin/login?return='.uri_string()));
        }
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }

    /**
     * Load Dashboard Views
     * @param string $page
     */
    public function admin_view($options = array()){
        if(! $options['page'] || ! $options['index']) return;
        $this->lang->load('dashboard',$this->get_lang());
        $this->data['lang'] = $this->lang;
        $this->data['page'] = $options['page'];
        $this->data['nav_index'] = $options['index'];
        $this->load->view('layouts/header',$this->data);
        $this->load->view('admin/'.(isset($options['folder'])?$options['folder'].'/':'').$options['page'],$this->data);
        $this->load->view('layouts/footer',$this->data);
    }

    private function _get_sys_langs(){
        $langs = $this->options->get('sys_langs');
        if(is_json($langs)) return json_decode($langs,true);
        return array();
    }

}