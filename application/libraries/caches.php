<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-04 10:39
 * File:    cache.php
 */

class Caches
{
    /**
     * CI句柄
     *
     * @access private
     * @var object
     */
    private $_CI;
    private $_Adapter;
    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct(){
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
        $this->_CI->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));

        if ($this->_CI->cache->memcached->is_supported())
            $this->_Adapter = $this->_CI->cache->memcached;
        else if($this->_CI->cache->apc->is_supported())
            $this->_Adapter =  $this->_CI->cache->apc;
        else
            $this->_Adapter =  $this->_CI->cache->file;
    }

    //Get Cache Key Value
    public function get($key, $value = FALSE){
        if(! $return = $this->_Adapter->get($key,$value)){
           $this->set($key,$value);
           $return = $value;
        }
        return $return;
    }

    //Set Cache Value
    public function set($key, $value, $expires = 86400){
        return $this->_Adapter->save($key,$value,$expires);
    }

    //Delete Cache Key or Clean Caches
    public function delete($key = FALSE){
        if(!$key)
            return $this->_Adapter->clean();
        return $this->_Adapter->delete($key);
    }
}