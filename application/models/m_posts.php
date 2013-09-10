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
}
