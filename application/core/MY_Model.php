<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-07 20:55
 * File:    base.php
 */
class MY_Model extends CI_Model
{
    /**
     * CI句柄
     *
     * @access private
     * @var object
     */
    public  $_CI;
    public  $_Adapter;
    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct(){
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
        $this->_CI->load->library('caches');
        $this->_Adapter = $this->_CI->caches;
    }

    /**
     * _required method returns false if the $data array does not contain all of the keys
     * assigned by the $required array.
     *
     * @param array $required
     * @param array $data
     * @return bool
     */
    function _required($required, $data)
    {
        foreach($required as $field) if(!isset($data[$field]) || !$data[$field]) return false;
        return true;
    }

    /**
     * _default method combines the options array with a set of defaults giving the values
     * in the options array priority.
     *
     * @param array $defaults
     * @param array $options
     * @return array
     */
    function _default($defaults, $options , $delete=FALSE)
    {
        foreach($options as $key=>$value){
            if( ! array_key_exists($key,$defaults))
                unset($options[$key]);
        }
        $result = array_merge($defaults, $options);
        if($delete)
            return $this->_delete_null($result);
        return $result;
    }

    private function _delete_null($options)
    {
        foreach($options as $key=>$value){
            if(!$value)
                unset($options[$key]);
        }
        return $options;
    }
}