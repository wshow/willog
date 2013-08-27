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
         if( ! $this->_required(array('table'),$options) || !$this->db->table_exists($options['table']))
             return false;

         $this->_CI->db->select('*')->from($options['table']);
         unset($options['table']);
         $return = isset($options['return']) ? true : false;
         unset($options['return']);
         if($options)
             $this->_CI->db->where($options);
         $result = $this->_CI->db->get()->result_array();
         if(count($result)==0) return false;
         if($return) return $result;
         return count($result)>1?$result:$result[0];
     }

     /**
      * 获取列表(分页)
      *
      * @access public
      * @return StatusArray
      */
     public function get_list($options =array()){
         if( ! $this->_required(array('table'),$options) || !$this->db->table_exists($options['table']))
             return false;
         //分页参数
         $page = $options['page'];
         $page_size = (isset($options['per_page'])&& !empty($options['per_page']) )?$options['per_page']:20;

         $page = ($page===false || (int)$page<=0) ? 1 : (int)$page;
         $page_size = ($page_size===false || (int)$page_size<=0) ? 1 : (int)$page_size;
         //获取满足条件的总数，并计算总页数
         $this->_CI->db
             ->select('count(*) as count')
             ->from($options['table'])
         ;
         if(isset($options['where']) && $options['where'])
             $this->_CI->db->where($options['where']);
         $count = $this->_CI->db->get()->row()->count;
         $page_count = ceil($count/$page_size);

         //从数据库中查询数据
         $this->_CI->db
             ->select('*')
             ->from($options['table']);
         if(isset($options['where']) && $options['where'])
             $this->_CI->db->where($options['where']);
         $this->_CI->db
             ->order_by((isset($options['order'])&&$options['order'])?$options['order']:'id desc')
             ->limit($page_size, ($page-1)*$page_size);

         $result = $this->_CI->db->get()->result_array();
         return array('status'=>1,'msg'=>'', 'data'=>array(
             'result' => $count>0?$result:array(),
             'count' => $count,
             'page_count' => $page_count>0?$page_count:1,
             'page_now' => $page
         ));
     }

     /**
      * 删除某一项
      *
      * @access public
      * @return StatusArray
      */
     public function delete($options = array()){
         if(! isset($options['table']) || !$options['table'])
             return array('status'=>0,'msg'=>'param_missing');
         $table = $options['table'];
         unset($options['table']);
         if(!$this->db->table_exists($table))
             return array('status'=>0,'msg'=>'table_not_exist');
         $status = $this->_CI->db->where($options)->delete($table);
         if(!$status)
             return array('status'=>0,'msg'=>'sql_error');
         return array('status'=>1,'msg'=>'delete_success');
     }

 }