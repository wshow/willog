<?php
/**
 * Created by JetBrains PhpStorm.
 * User: willin
 * Date: 2013-7-20 下午11:19
 */
class MY_Controller extends CI_Controller{
    private  $_site_lang = '';
    private  $_cur_lang = '';
    public $data;

    public function __construct(){
        parent::__construct();
        $this->_site_lang = $this->options->get('site_lang');
        $this->data['site_name'] = $this->options->get('site_name',$this->get_lang());
    }

    public function get_lang(){
        return $this->_cur_lang;
    }

    private function _get_lang($lang=false){
        if($lang != 'cn' && $lang != 'en'){
            return $this->_site_lang;
        }
        $this->data['site_name'] = $this->options->get('site_name',$lang);
        return $lang;
    }

    public function _remap($method, $params=array()){
        if(count($params)==0)
            $this->_cur_lang=$this->_get_lang();
        else{
            $this->_cur_lang=$this->_get_lang($params[0]);
            if($this->_cur_lang==$params[0])
                $params=array_delete($params,0);
        }if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }
}