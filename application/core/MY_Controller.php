<?php
/**
 * Created by JetBrains PhpStorm.
 * User: willin
 * Date: 2013-7-20 下午11:19
 */
class MY_Controller extends CI_Controller{
    private  $site_lang = '';
    public $lan = '';

    public function __construct(){
        parent::__construct();
        $this->site_lang = $this->options->get_option('site_lang');
    }

    private function _get_lang($lang=false){
        if($lang != 'cn' && $lang != 'en'){
            return $this->site_lang;
        }
        return $lang;
    }

    public function _remap($method, $params=array()){
        if(count($params)==0)
            $this->lan=$this->_get_lang();
        else{
            $this->lan=$this->_get_lang($params[0]);
            if($this->lan==$params[0])
                $params=array_delete($params,0);
        }if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }
}