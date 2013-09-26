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

    public function w_get_language_links($cur_lang = '',$echo = false){
        global $opt;
        $html = '';
        $langs = explode(',',$opt['site_langs']);
        $tips = $opt['sys_langs'];
        if($langs){
            foreach($langs as $lang){
                $url = base_url((($lang==$opt['site_lang']) ? '' : $lang).'/'.(str_replace($lang,'',str_replace($cur_lang,'',uri_string()))));
                $html .= "<li><a href=\"{$url}\" class=\"{$lang}\">{$tips[$lang]}</a></li>";
            }
            if($html != '')
                $html = '<ul class="language">'.$html.'</ul>';
        }
        if(!$echo)
            return $html;
        echo $html;
    }

    public function w_get_archives($lang = '',$echo = false){
        $html = '';

        $this->_CI->load->model('m_posts');
        $archives = $this->_CI->m_posts->get_archives();
        if($archives){
            foreach($archives as $archive){
                $url = base_url($lang.'/'.$archive['year'].'/'.$archive['month'].'/');
                $html .= "<li><a href=\"{$url}\">{$archive['year']}-{$archive['month']} ({$archive['posts']})</a></li>";
            }
            if($html != '')
                $html = '<ul class="archives">'.$html.'</ul>';
        }
        if(!$echo)
            return $html;
        echo $html;
    }

    public function w_404($data = false){
        global $opt;
        $this->_CI->load->view( $opt['site_theme'].'/404',$data);
    }
}