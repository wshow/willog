<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archive extends MY_Controller {

    public function __construct(){
        parent::__construct();
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($year=false,$mon=false,$day=false,$p=false,$page=false)
	{
        if($mon=='page'){
            $page=$day;
            $p=$mon;
            $mon=false;
            $day=false;
        }
        if($day=='page'){
            $page=$p;
            $p=$day;
            $day=false;
        }
        if(!is_numeric($year))
            show_404();
        $this->lang->load('archive',$this->get_lang());

        echo $this->get_lang().'<br>';
        echo $year.'-'.($mon?$mon:'0').'-'.($day?$day:'0').'<br>';
        if($p=='page'){
            //$page 分页
            echo 'page:'.$page;
        }
        echo '<br>'.$this->lang->line('test');
	}

    public function search($search=false,$p=false,$page=false){
        if($p && $p!='page')
            show_404();

        if($p=='page'){
            //$page 分页
        }
    }
}

/* End of file post.php */
/* Location: ./application/controllers/post.php */