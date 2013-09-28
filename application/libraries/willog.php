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

    public function w_parse_post($post,$base_url = '',$lang=''){
        foreach($post as $key=>$value){
            if(!is_array($value) && is_json($value)){
                $post[$key] = json_decode($value,true);
                $post[$key] = isset($post[$key][$lang])?$post[$key][$lang]:$post[$key];
            }
        }
        $post['terms'] = $this->w_get_terms($post['terms'],$base_url,$lang);
        return $post;
    }

    public function w_get_terms($terms = array(),$base_url='',$lang = ''){
        $result = array('city'=>'','tag'=>'','category'=>'');
        if(count($terms)>0){
            foreach($terms as $term){
                $term['name'] = json_decode($term['name'],true);
                if($term['taxonomy'] == 'city'){
                    $url = $base_url.'city/'.$term['slug'];
                    $result['city'] = "<a href=\"{$url}\">{$term['name'][$lang]}</a>";
                }else if($term['taxonomy'] == 'tag'){
                    $url = $base_url.'tag/'.$term['slug'];
                    $result['tag'] = ((isset($result['tag']))?$result['tag'].' , ':'')."<a href=\"{$url}\">{$term['name'][$lang]}</a>";
                }else if($term['taxonomy'] == 'category'){
                    $url = $base_url.'category/'.$term['slug'];
                    $result['category'] = ((isset($result['category']))?$result['category'].' , ':'')."<a href=\"{$url}\">{$term['name'][$lang]}</a>";
                }
            }
        }
        return $result;
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

    public function w_get_widget_terms($type = '',$lang = '',$base_url){
        $this->_CI->load->model('m_terms');
        $terms = $this->_CI->m_terms->filter($type);
        return $this->_create_html($terms,$lang,$base_url);
    }

    private function _create_html($items,$lang = 'cn',$base_url = '')
    {

        $html = '';
        if(is_array($items) && count($items)>0){
            $html.='<ul>';
            foreach($items as $item){
                $name = json_decode($item['name'],true);
                $name = isset($name[$lang])?$name[$lang]:(isset($name[0])?$name[0]:'');
                $html.= "<li><a href=\"{$base_url}{$item['taxonomy']}/{$item['slug']}\">{$name} ({$item['count']})</a>";
            if(isset($item['children']) && is_array($item['children']))
                $html .= $this->_create_html($item['children'],$lang,$base_url);
                $html .='</li>';
        }
            $html.='</ul>';
        }
        return $html;
    }

    public function w_404($data = false){
        global $opt;
        $this->_CI->load->view( $opt['site_theme'].'/404',$data);
    }

}