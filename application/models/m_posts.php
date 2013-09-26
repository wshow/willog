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
    public function check_slug($slug = false,$id = false)
    {
        if(!$slug)
            return array('status'=>0,'msg'=>'param_missing');
        if(is_numeric($slug))
            return array('status'=>0,'msg'=>'no_numeric');
        $this->_CI->db->select('count(*) as count')->from('posts')
            ->where('slug',$slug)
        ;
        if($id)
            $this->_CI->db->where('id <>',$id);
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
    public function insert($options = array(),$metas = array()){
        $default = array(
            'slug' => '',
            'name' => '',
            'content' => '',
            'thumb' => '',
            'status' => 'draft',
            'device' => 'desktop',
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

        $slug_staus = $this->check_slug($options['slug']);
        if($slug_staus['status']==0)
            return array('status'=>0,'msg'=>'already_exist');


        $status = $this->_CI->db->insert('posts',$options);
        if(! $status)
            return array('status'=>0,'msg'=>'sql_error');
        return $this->insert_meta($this->_CI->db->insert_id(),$metas);
    }

    public function update($id = 0,$options = array(),$metas = array()){
        $default = array(
            'slug' => '',
            'name' => '',
            'content' => '',
            'thumb' => '',
            'status' => 'draft',
            'device' => 'desktop',
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

        $slug_staus = $this->check_slug($options['slug'],$id);
        if($slug_staus['status']==0)
            return array('status'=>0,'msg'=>'already_exist');


        $status = $this->_CI->db->where('id',$id)->update('posts',$options);
        if(! $status)
            return array('status'=>0,'msg'=>'sql_error');
        return $this->insert_meta($id,$metas);
    }

    /**
     * 添加文章Meta
     *
     * @access public
     * @return StatusArray
     */
    public function insert_meta($post_id,$options = array()){
        $this->_CI->db->select('id')->from('postmeta')->where('post_id',$post_id);
        $metas = $this->_CI->db->get()->result_array();

        $data_id = array();
        if(count($metas)>0){
            foreach($metas as $meta){
                array_push($data_id,$meta['id']);
            }
        }

        $data = array();
        foreach($options as $key=>$value){
            if(is_array($value)){
                foreach($value as $v){
                    $temp = array();
                    $temp['post_id'] = $post_id;
                    $temp['meta_key'] = $key;
                    $temp['meta_value'] = $v;
                    array_push($data,$temp);
                }
            }else{
                $temp = array();
                $temp['post_id'] = $post_id;
                $temp['meta_key'] = $key;
                $temp['meta_value'] = $value;
                array_push($data,$temp);
            }
        }

        foreach($data as $item){
            if(count($data_id)>0)
                $item['id'] = array_shift($data_id);
            if(isset($item['id']))
                $this->_CI->db->where('id',$item['id'])->update('postmeta',$item);
            else
                $this->_CI->db->insert('postmeta',$item);
        }
        if(count($data_id)>0)
            $this->_CI->db->where_in('id',$data_id)->delete('postmeta');
        
        return array('status'=>1,'msg'=>'insert_success');
    }

    public function get_archives(){
        return $this->_CI->db->query("SELECT YEAR(created_at) AS `year`, MONTH(created_at) AS `month`, count(ID) as posts FROM `w_posts` WHERE `status` <> 'draft' GROUP BY YEAR(created_at), MONTH(created_at) ORDER BY created_at asc ")->result_array();
    }
}
