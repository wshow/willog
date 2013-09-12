<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-12 17:46
 * File:    post_metas.php
 */
Class M_Post_metas extends MY_Model
{
    /**
     * 添加文章Meta
     *
     * @access public
     * @return StatusArray
     */
    public function update_or_insert($post_id,$options = array()){

        $status = true;

        if(! $status)
            return array('status'=>0,'msg'=>'sql_error');
        return array('status'=>1,'msg'=>'insert_success');
    }
}