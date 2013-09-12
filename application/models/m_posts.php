<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-10 15:46
 * File:    m_posts.php
 */
Class M_Posts extends MY_Model
{
    /**
     * 检测Slug是否存在
     *
     * @access public
     * @return boolean
     */
    public function check_slug($slug = false)
    {
        if(!$slug)
            return array('status'=>0,'msg'=>'param_missing');
        if(is_numeric($slug))
            return array('status'=>0,'msg'=>'no_numeric');
        $this->_CI->db->select('count(*) as count')->from('posts')
            ->where('slug',$slug)
        ;
        $result = $this->_CI->db->get()->row_array();
        if($result['count']>0)
            return array('status'=>0,'msg'=>'already_exist');
        return array('status'=>1,'msg'=>'available');
    }


    /**
     * 新增文章
     *
     * @access public
     * @return StatusArray
     */
    public function insert($options = array()){
        $default = array(
            'slug' => '',
            'name' => '',
            'content' => '',
            'thumb' => '',
            'status' => 'draft',
            'type' => 'post',
            'lng' => 0,
            'lat' => 0,
            'address' => '',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );
        if( ! $this->_required(array('slug','name'),$options)){
            return array('status'=>0,'msg'=>'param_missing');
        }
        $options = $this->_default($default,$options);
        if(is_numeric($options['slug']))
            return array('status'=>0,'msg'=>'no_numeric');

        $options['slug'] = strtolower($options['slug']);
        $options['name'] = encode_json($options['name']);
        $options['content'] = encode_json($options['content']);
        $options['address'] = encode_json($options['address']);

        if($this->check_slug($options['slug'])>0)
            return array('status'=>0,'msg'=>'already_exist');


        $status = $this->_CI->db->insert('terms',$options);
        if(! $status)
            return array('status'=>0,'msg'=>'sql_error');
        return array('status'=>1,'msg'=>'insert_success','post_id'=>$this->_CI->db->insert_id());
    }
}
