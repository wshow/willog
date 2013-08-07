<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-07 20:58
 * File:    users.php
 */
 Class Users extends MY_Model
 {
     public function log($options = array()){
         //Set Default
         $detault = array(
             'username' => '',
             'password' => '',
             'login_ip' => $this->_CI->input->ip_address(),
             'login_ua' => $this->_CI->agent->agent,
             'login_valid' => 0,
             'created_at' => date("Y-m-d H:i:s")
         );
         //Set Log
         $options = $this->_default($detault,$options);
         $this->db->insert('login_logs',$options);
     }

     public function login($options = array()){
         //Check Blank
         if( ! $this->_required(array('username','password'),$options)){
             return array('status'=>false,'msg'=>'blank_username_or_password');
         }
         //Cannot Login 30min > 5 Failures
         if( ! $this->can_login() ){
             return array('status'=>false,'msg'=>'login_limit');
         }
         //Check Email or Username
         $logininfo = array();
         if( valid_email($options['username']) )
             $logininfo['email'] = $options['username'];
         else
             $logininfo['username'] = $options['username'];
         $userinfo = $this->get($logininfo);
         if(! $userinfo)
         {
             $this->log($options);
             return array('status'=>false,'msg'=>'wrong_user');
         }
         //Check Password
         if(sha1($options['password'].$userinfo['salt'])==$userinfo['password'])
         {
             $this->log($options);
             return array('status'=>false,'msg'=>'wrong_password');
         }
         //Set Login Session
         $this->_set_session($userinfo);
         $options['login_valid'] = 1;
         $this->log($options);
         return array('status'=>true,'msg'=>'login_success');
     }
     public function can_login(){
         $options = array(
             'login_ip' => $this->_CI->input->ip_address(),
             'login_ua' => $this->_CI->agent->agent,
             'login_valid' => 0,
             'created_at >'=> date("Y-m-d H:i:s",time()-1800)
         );
         $this->_CI->db->select('count(*) as count')->from('login_logs')->where($options);
         return $this->_CI->db->get()->row()->count>5 ? false : true;
     }

     /**
      * 获取用户基本信息
      *
      * @access public
      * @return RowArray || ResultArray
      */
     public function get($options= array()){
         $this->_CI->db->select('*')->from('users');
         if($options)
             $this->_CI->db->where($options);
         $users = $this->_CI->db->get()->result_array();
         return count($users)>1?$users:$users[0];
     }

     public function insert($options = array()){}

     public function update($options = array()){}

     public function delete($options = array()){}

     public function check_email($email){
         $this->_CI->db->select('count(*) as count')->from('users')->where('email',$email);
         return $this->_CI->db->get()->row()->count;
     }

     /**
      * 设置用户Session
      *
      * @access private
      * @return void
      */
     private function _set_session($userinfo){
         $userinfo['timespan'] = time();
         $session_data = array('user' => serialize($userinfo));
         $this->_CI->session->set_userdata($session_data);
     }

     /**
      * 读取用户Session
      *
      * @access public
      * @return Array
      */
     public function get_session(){
         $all = $this->_CI->session->all_userdata();
         if(!isset($all['user']))
             return FALSE;
         $user = unserialize( $all['user'] );
         if($all['last_activity']>$user['timespan']){
             $this->_set_session( $this->get(array('id'=>$user['id'])) );
             $user = $this->get_session();
         }
         return $user;
     }
 }