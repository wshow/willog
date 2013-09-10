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
        //Check IS_LOGIN
        if(!empty($this->cur_user))
            redirect(base_url('/admin'));

        //Load Language and Error msg
        $this->lang->load('admin_login',$this->get_lang());
        $this->data['lang'] = $this->lang;
        $msg = $this->input->get('msg');if( $msg ){
            $this->lang->load('msg',$this->get_lang());
            $msg = $this->lang->line($msg);
            if( $msg )
                $this->data['msg'] = $msg;
        }
        //Load View
        $this->load->view('login',$this->data);
    }

    public function submit()
    {
        $result = $this->m_users->login($this->input->post('p'));
        //AJAX Handler
        if(is_ajax()){
            $this->lang->load('msg',$this->get_lang());
            $result['msg'] = $this->lang->line($result['msg']);
            json_result($result);
        }
        //General Redirect
        if(! $result['status'])
            redirect(base_url('/admin/login?msg='.$result['msg']));
        else{
            if($return = $this->input->get('return'))
                redirect(base_url('/'.$return));
            if ($this->agent->is_referral() && !strpos($this->agent->referrer(),'admin/login'))
                redirect($this->agent->referrer());
            else
                redirect(base_url('/admin'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('/admin/login'));
    }
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */