<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-26 15:00
 * File:    willog.php
 */

class Willog
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
    }

    public function w_get_language_links($echo = false){
        global $opt;
        $html = '';
        $langs = explode(',',$opt['site_langs']);
        $tips = $opt['sys_langs'];
        if($langs){
            foreach($langs as $lang){
                $url = base_url((($lang==$opt['site_lang']) ? '' : $lang).'/'.uri_string());
                $html .= "<li><a href=\"{$url}\" class=\"{$lang}\">{$tips[$lang]}</a></li>";
            }
            if($html != '')
                $html = '<ul class="language">'.$html.'</ul>';
        }
        if(!$echo)
            return $html;
        echo $html;
    }
}