<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Author: willin
 * Date: 12-11-9  下午11:24
 * Created by JetBrains PhpStorm.
 */

class Options
{
    /**
     * CI句柄
     *
     * @access private
     * @var object
     */
    private $_CI;
    private $_Adapter;

    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct(){
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
        $this->_CI->load->library('caches');
        $this->_Adapter = $this->_CI->caches;
    }

    /**
     * 获取变量
     *
     * @access public
     * @return list
     */
    public function get($keys=null,$lang=FALSE,$by_id=FALSE){
        if( ! $options = $this->_Adapter->get('options') )
            $options = $this->_set_options(TRUE);
        if(!$keys) return $options;
        $data=array();
        if(!is_array($keys)) $keys=array($keys);
        if(is_array($options)){
            foreach($options as $option){
                if(in_array($option[$by_id?'id':'key'],$keys))
                    $data=array_insert($data,$option);
            }
        }
        if(count($keys)==1 && count($data)==1){
            $return = array();
            if( $lang && is_json($data[0]['value']) )
                $return = json_decode($data[0]['value'],true);
            if($lang && isset($return[$lang]))
                return $return[$lang];
            return $data[0]['value'];
        }
        else
            return $data?$data:NULL;
    }

    /**
     * 新增配置
     *
     * @access public
     * @return int
     */
    public function insert($options){
        $this->_CI->db
            ->insert_batch('options',$options)
        ;
        $rows=$this->_CI->db->affected_rows();
        if($rows > 0) $this->_set_options();
        return ($rows > 0) ? $rows : FALSE;
    }

    /**
     * 删除配置
     *
     * @access public
     * @return int
     */
    public function delete($options,$by_id=FALSE){
        $this->_CI->db
            ->where('autoload','no')
            ->where_in($by_id?'id':'key',$options)
            ->delete('options')
        ;
        $rows=$this->_CI->db->affected_rows();
        if($rows > 0) $this->_set_options();
        return ($rows > 0) ? $rows : FALSE;
    }

    /**
     * 修改配置
     *
     * @access public
     * @return int
     */
    public function update($options,$by_id=FALSE){
        if(isset($options[0]) && is_array($options[0])){
            $this->_CI->db
                ->update_batch('options',$options,$by_id?'id':'key')
            ;
        }
        else{
            $this->_CI->db
                ->update('options',$options,array(($by_id?'id':'key')=>$options[($by_id?'id':'key')]))
            ;
        }
        $rows=$this->_CI->db->affected_rows();
        if($rows > 0)
            $this->_set_options();
        else
            $rows = $this->insert($options);
        return ($rows > 0) ? $rows : FALSE;
    }

    /**
     * 更新站点配置
     *
     * @access private
     * @return void
     */
    private  function _set_options($return=FALSE){
        $this->_CI->db
            ->select('*')
            ->from('options');
        $options = $this->_CI->db->get()->result_array();
        $options = array_insert($options,array('id'=>'0','key'=>'cached_time','value'=>date('Y-m-d H:i:s')),0);
        $this->_Adapter->set('options', $options , 3600*24);

        if($return){
            return $this->_Adapter->get('options');
        }

    }

}