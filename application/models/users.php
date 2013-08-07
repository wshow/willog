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
         $detault = array(
             'username' => '',
             'password' => '',
             'login_ip' => $this->_CI->input->ip_address(),
             'login_ua' => $this->_CI->agent->agent,
             'login_valid' => 0,
             'created_at'=> date("Y-m-d H:i:s")
         );
         $options = $this->_default($detault,$options);
         header('Content-Type: Text/JSON');
         echo json_encode($options);
         exit;
     }

     public function login($options = array()){}

     public function insert($options = array()){}

     public function update($options = array()){}

     public function delete($options = array()){}
 }