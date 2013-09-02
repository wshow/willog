<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-02 17:46
 * File:    m_options.php
 */
 class M_Options extends MY_Model
 {
     public function get(){
         $this->_CI->db
             ->select('*')
             ->from('options');
         $options = $this->_CI->db->get()->result_array();
         $result = array();
         foreach($options as $option){
            $result[$option['key']] = $option['value'];
                if(is_json($result[$option['key']]))
                    $result[$option['key']] = json_decode($result[$option['key']],true);
          }
         return $result;
     }

 }