<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-20 10:11
 * File:    paginators.php
 */

class Paginators
{
    /**
     * CI句柄
     *
     * @access private
     * @var object
     */
    private $_CI;
    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct(){
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
        $this->_CI->load->library('pagination');
    }

    public function config($options = array())
    {
        $default = array(
            'base_url'=>'',
            'total_rows'=> 0,
            'per_page' => 20,
            'uri_segment' => 3,
            'num_links' => 3,
            'use_page_numbers' => true,
            //'enable_query_strings' => true,
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
            'first_link' => '&laquo;',
            'last_link' => '&raquo;',
            'next_link' => '&gt;',
            'prev_link' => '&lt;',
            'first_tag_open' => '<li class="arrow">',
            'last_tag_open' => '<li class="arrow">',
            'next_tag_open' => '<li class="arrow">',
            'prev_tag_open' => '<li class="arrow">',
            'cur_tag_open' => '<li class="current"><a>',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_close' => '</li>',
            'next_tag_close' => '</li>',
            'prev_tag_close' => '</li>',
            'num_tag_close' => '</li>'
        );
        $options = $this->_merge($default,$options);
        $this->_CI->pagination->initialize($options);
    }

    public function output()
    {
        return $this->_CI->pagination->create_links();
    }

    private function _merge($defaults, $options)
    {
        foreach($options as $key=>$value){
            if( ! array_key_exists($key,$defaults))
                unset($options[$key]);
        }
        $result = array_merge($defaults, $options);

        return $result;
    }
}