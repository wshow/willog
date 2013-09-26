<?php
/**
 * Created by JetBrains PhpStorm.
 * User: willin
 * Date: 2013-7-20 下午11:19
 */
class MY_Controller extends CI_Controller{
    public $site_lang = '';
    public $cur_lang = '';
    public $theme = 'default';
    public $data;

    public function __construct(){
        parent::__construct();
        $this->load->library('willog');
        global $opt;
        $this->data['opt'] = $opt = $this->options->get_all();
        //json_result($opt);
        $this->site_lang = $opt['site_lang'];
        $this->theme = $opt['site_theme'];
        $this->data['site_name'] = $opt['site_name'][$this->_get_lang()];
        $this->data['base_url'] = base_url($this->_get_lang()==$this->site_lang?'':$this->_get_lang());
        $this->data['cur_lang'] = $this->_get_lang();
    }


    private function _get_lang($lang=false){
        if($lang != 'cn' && $lang != 'en'){
            return $this->site_lang;
        }
        $this->data['site_name'] = $this->options->get('site_name',$lang);
        return $lang;
    }

    public function _remap($method, $params=array()){
        if(count($params)==0)
            $this->cur_lang=$this->_get_lang();
        else{
            $this->cur_lang=$this->_get_lang($params[0]);
            if($this->cur_lang==$params[0])
                $params=array_delete($params,0);
        }
        $this->data['cur_lang'] = $this->cur_lang;
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }
}