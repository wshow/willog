<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-17 21:50
 * File:    m_db.php
 */
 class M_db extends MY_Model
 {
     /**
      * Select without Pagination 获取(不含分页)
      *
      * @access public
      * @return RowArray || ResultArray
      */
     public function get($options= array()){
         if( ! $this->_required(array('table'),$options))
             return false;
         $this->_CI->db->select('*')->from($options['table']);
         unset($options['table']);
         if($options)
             $this->_CI->db->where($options);
         $result = $this->_CI->db->get()->result_array();
         if(count($result)==0) return false;
         return count($result)>1?$result:$result[0];
     }

     /**
      * 获取列表(分页)
      *
      * @access public
      * @return StatusArray
      */
     public function get_list($options =array()){
         if( ! $this->_required(array('table'),$options))
             return false;
         //分页参数
         $page = $options['page'];
         $page_size = (isset($options['page_size'])&& !empty($options['page_size']) )?$options['page_size']:20;

         $page = ($page===false || (int)$page<=0) ? 1 : (int)$page;
         $page_size = ($page_size===false || (int)$page_size<=0) ? 1 : (int)$page_size;

         $this->_CI->db
             ->select('count(1) as count,'.$options['table'].'.*')
             ->from($options['table']);
         if(isset($options['where']) && $options['where'])
             $this->_CI->db->where($options['where']);
         $this->_CI->db
             ->order_by((isset($options['order'])&&$options['order'])?$options['order']:'id desc')
             ->limit($page_size, ($page-1)*$page_size);

         $result = $this->_CI->db->get()->result_array();
         $count = (int)$result[0]['count'];
         $page_count = ceil($count/$page_size);
         return array('status'=>1,'msg'=>'', 'data'=>array(
             'result' => $count>0?$result:array(),
             'count' => $count,
             'page_count' => $page_count>0?$page_count:1,
             'page_now' => $page
         ));
     }

 }