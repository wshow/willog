<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-07 20:58
 * File:    users.php
 */
 Class M_Users extends MY_Model
 {
     /**
      * 写登录日志
      *
      * @access public
      * @return void
      */
     public function log($options = array()){
         //Set Default
         $detault = array( // Default Setting Must Include All Columns
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

     /**
      * 登录
      *
      * @access public
      * @return StatusArray
      */
     public function login($options = array()){
         //Check Blank
         if( ! $this->_required(array('username','password'),$options)){
             return array('status'=>0,'msg'=>'blank_username_or_password');
         }
         //Cannot Login 30min > 5 Failures
         if( ! $this->can_login() ){
             return array('status'=>0,'msg'=>'login_limit');
         }
         //Check Email or Username
         $logininfo = array();
         $options['username'] = strtolower($options['username']);
         if( valid_email($options['username']) )
             $logininfo['email'] = $options['username'];
         else
             $logininfo['username'] = $options['username'];
         $logininfo['table'] = 'users';
         $userinfo = $this->_CI->m_db->get($logininfo);
         if(!$userinfo)
         {
             $this->log($options);
             return array('status'=>0,'msg'=>'wrong_user');
         }
         //Check Password
         if(sha1($options['password'].$userinfo['salt'])!=$userinfo['password'])
         {
             $this->log($options);
             return array('status'=>0,'msg'=>'wrong_password');
         }
         //Set Login Session
         $remember = $options['remember']==1?TRUE:FALSE;
         $this->_set_session($userinfo,$remember);
         $options['login_valid'] = 1;
         $this->log($options);
         return array('status'=>1,'msg'=>'login_success');
     }

     /**
      * 判断能否登录
      *
      * @access public
      * @return boolean
      */
     public function can_login(){
         $options = array(
             'login_ip' => $this->_CI->input->ip_address(),
             'login_ua' => $this->_CI->agent->agent,
             'login_valid' => 0,
             'created_at >'=> date("Y-m-d H:i:s",time()-1800)
         );
         $this->_CI->db->select('count(*) as count')->from('login_logs')->where($options);
         return $this->_CI->db->get()->row()->count<5 ? true : false;
     }

     /**
      * 新增用户
      *
      * @access public
      * @return StatusArray
      */
     public function insert($options = array()){
         $default = array(
             'username' => '',
             'email' => '',
             'password' => '',
             'salt' => '',
             'nickname' => '',
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s")
         );
         if( ! $this->_required(array('username','password'),$options)){
             return array('status'=>0,'msg'=>'blank_username_or_password');
         }
         $options['username'] = strtolower($options['username']);
         $options['email'] = strtolower($options['email']);
         if($this->check_register($options)>0)
             return array('status'=>0,'msg'=>'user_exist');
         $options['salt'] = random_string('alnum',10);
         $options['password'] = sha1($options['password'].$options['salt']);

         $options = $this->_default($default,$options);
         $status = $this->_CI->db->insert('users',$options);
         if(! $status)
             return array('status'=>0,'msg'=>'sql_error');
         return array('status'=>1,'msg'=>'insert_success');
     }

     /**
      * 修改用户信息
      *
      * @access public
      * @return StatusArray
      */
     public function update($options = array()){
         $default = array(
             'username' => '',
             'email' => '',
             'password' => '',
             'salt' => '',
             'nickname' => '',
             'reset_key' => '',
             'updated_at' => date("Y-m-d H:i:s")
         );
         if( ! $this->_required(array('username'),$options))
             return array('status'=>0,'msg'=>'blank_username');
         if(isset($options['password']) && !empty($options['password'])){
             $options['salt'] = random_string('alnum',10);
             $options['password'] = sha1($options['password'].$options['salt']);
         }
         if(isset($options['reset_key']))
             $options['reset_key'] = random_string('alnum',32);
         $options = $this->_default($default,$options,true);
         $options['username'] = strtolower($options['username']);
         $options['email'] = strtolower($options['email']);

         $status = $this->db->where('username',$options['username'])->update('users',$options);
         if(!$status)
             return array('status'=>0,'msg'=>'sql_error');
         if(isset($options['reset_key']) && $options['reset_key'])
            return array('status'=>1,'msg'=>'update_success','data'=>$options['reset_key']);
         return array('status'=>1,'msg'=>'update_success');
     }

     /**
      * 删除用户
      *
      * @access public
      * @return StatusArray
      */
     public function delete($options = array()){
         $default = array(
             'id'=>'',
             'username' => '',
             'email' => ''
         );
         if(!$options)
             return array('status'=>0,'msg'=>'param_missing');
         $options = $this->_default($default,$options,true);
         $status = $this->_CI->db->where($options)->delete('users');
         if(!$status)
             return array('status'=>0,'msg'=>'sql_error');
         return array('status'=>1,'msg'=>'delete_success');
     }

     /**
      * 检查能否注册
      *
      * @access public
      * @return integer
      */
     public function check_register($options){
         $default = array(
             'username' => '',
             'email' => ''
         );
         $options = $this->_default($default,$options);
         $this->_CI->db->select('count(*) as count')->from('users')->or_where($options);
         return $this->_CI->db->get()->row()->count;
     }

     /**
      * 设置用户Session
      *
      * @access private
      * @return void
      */
     private function _set_session($userinfo,$remember = TRUE){
         $userinfo['timespan'] = time();
         $session_data = array('user' => serialize($userinfo));
         if(!$remember)
             $this->_CI->session->sess_expiration = 7200;
         $this->_CI->session->set_userdata($session_data);
     }

     /**
      * 读取用户Session
      *
      * @access public
      * @return Array
      */
     public function get_session($key = FALSE){
         $all = $this->_CI->session->all_userdata();
         if(!isset($all['user']))
             return FALSE;
         $user = unserialize( $all['user'] );
         if($all['last_activity']>$user['timespan']){
             $this->_set_session( $this->_CI->m_db->get(array('table'=>'users','id'=>$user['id'])) );
             $user = $this->get_session();
         }
         if($key) return isset($user[$key])?$user[$key]:false;
         return $user;
     }

     /**
      * 读取用户是否登录
      *
      * @access public
      * @return Boolean
      */
     public function is_login(){
         return $this->get_session('id')?true:false;
     }


     public function check_user(){
         $this->_CI->db
             ->select('count(*) as count')
             ->from('users')
         ;
         $count = $this->_CI->db->get()->row()->count;
         if($count > 0) return true;
         $default = array(
             'username' => 'willin',
             'email' => 'willin@willin.org',
             'password' => 'willin',
             'salt' => random_string('alnum',10),
             'nickname' => 'Willin Wang',
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s")
         );
         $this->insert($default);
     }

 }