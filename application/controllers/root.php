<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Root extends MY_Controller {

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
	public function index($p=false,$page=1)
	{
        if(!is_numeric($page))  $this->willog->w_404($this->data);
        $arg = array(
            'table' => 'posts',
            'page' => $page,
            'per_page' => 5,
            'where' => array('type' => 'post'),
            'select' => "w_posts.*,(select group_concat(meta_value) from w_postmeta where ( post_id = w_posts.id) and ( meta_key = 'category' or meta_key = 'city' or meta_key ='tag')) as terms",
            'order_by' => 'created_at desc'
            //'select' => "w_posts.*,(select group_concat('\\\"',taxonomy,'-',id,'\\\":',`name`) from w_terms where id in (select meta_value from w_postmeta where post_id = w_posts.id)) as terms"
        );
        $posts = $this->m_db->get_list($arg);
        $post_id = array();
        foreach($posts['data']['result'] as &$post){
            array_push($post_id,$post['id']);
            if($post['terms'] ){
                $post['terms'] = rtrim($post['terms'], ",");
                $post['terms'] = $this->db->query("select * from w_terms where id in ({$post['terms']})")->result_array();
            }
        }
        if(count($post_id)>0)
            $this->willog->w_view($post_id);
//        json_result($posts);
//        exit();
        include(__DIR__.'/../../themes/'.$this->data['opt']['site_theme'].'/language.php');
        foreach($posts['data']['result'] as &$post){
            $post = $this->willog->w_parse_post($post,$this->data['base_url'],$this->data['cur_lang']);
            $post['address'] =create_geolocation($post['lat'],$post['lng'],isset($lang['distance'])?$lang['distance']:'').$post['address'];
            $post['expert'] = create_map($post['lat'],$post['lng']).$post['content'];
            $post['meta'] = "{$lang['category']}: {$post['terms']['category']}, {$lang['tag']}: {$post['terms']['tag']}<br>{$lang['created']}:{$post['created_at']}, {$lang['views']}: {$post['views']}";
            if($post['comments']>0) $post['meta'] .= ", {$lang['comments']}:{$post['comments']}";

        }
        if(is_ajax())
            json_result($posts);
        $this->data['posts'] = $posts;
        $this->paginators->config(array(
            'base_url' => $this->data['base_url'].'/page/',
            'total_rows' => $this->data['posts']['data']['count'],
            'uri_segment' => 3
        ));
        $this->load->view($this->theme.'/index',$this->data);
	}

    public function post($id_or_slug){
        if(is_numeric($id_or_slug))
            echo 'number<br>';
        $this->willog->w_404($this->data);
    }

    public function e404(){
        $this->load->view($this->theme.'/404',$this->data);
    }
}

/* End of file root.php */
/* Location: ./application/controllers/root.php */