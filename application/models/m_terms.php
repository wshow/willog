<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-17 21:40
 * File:    m_terms.php
 */
Class M_Terms extends MY_Model
{
    /**
     * 序列化
     *
     * @access public
     * @preturn array
     */
    public function filter($type = 'category')
    {
        if($type != 'city' && $type != 'category') $type='category';
        $input = $this->m_db->get(array('select'=>"*,(select count(1) from w_postmeta where meta_key='{$type}' and meta_value= w_terms.id) as count",'table'=>'terms','return'=>true,'taxonomy'=>$type));
        if(!$input) return array();
        //Get Tree
        $items = array();
        foreach($input as $item)
            $items[$item['id']] = $item;
        foreach ($items as $item)
            $items[$item['parent_id']]['children'][$item['id']] = &$items[$item['id']];
        return isset($items[0]['children']) ? $items[0]['children'] : array();
    }

    public function create_checkbox($items,$lang = 'cn',$dept = 0,$selected = false)
    {
        $html = '';
        foreach($items as $item){
            if(is_json($item['name'])) $item['name'] = json_decode($item['name'],true);
            $item_name = isset($item['name'][$lang]) ? $item['name'][$lang] : $item['name'];
            $html .= "<li><label for=\"term-{$item['id']}\">";
            $html .= "<input type=\"checkbox\" name=\"m[{$item['taxonomy']}][]\" value=\"{$item['id']}\" ";
            if(is_array($selected) && in_array($item['id'],$selected)) $html .= 'checked="checked"';
            $html .= " id=\"term-{$item['id']}\"> {$item_name} </label>";
            if(isset($item['children']) && is_array($item['children'])){
                $html .= '<ul class="children">';
                $html .= $this->create_checkbox($item['children'],$lang,$dept+1,$selected);
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }

    public function create_html($items,$lang = 'cn',$type = 'option',$dept=0,$curent_item = false)
    {
        if($type != 'table' && $type != 'option') $type='option';
        $html = '';
        foreach($items as $item){
            $name = json_decode($item['name'],true);
            $sep = str_repeat('-',$dept);
            if(is_array($curent_item) && $curent_item['id']==$item['id']){
                // Do Nothing
            }
            else{
                if($type=='option'){
                    $html .= "<option value=\"{$item['id']}\"> {$sep} {$name[$lang]}</option>";
                }else{
                    $this->_CI->load->language('dashboard',$lang);
                    $edit = $this->_CI->lang->line('edit');
                    $delete = $this->_CI->lang->line('delete');
                    $taxonomy = $item['taxonomy']=='city'?'cities':'categories';
                    $base = base_url('/admin');
                    $html .= "<tr><td> {$sep} {$name[$lang]}</td><td>{$item['slug']}</td><td>{$item['desc']}</td><td><a href=\"{$base}/posts?{$item['taxonomy']}={$item['id']}\">{$item['count']}</a></td><td><a href=\"{$base}/{$taxonomy}/action/edit/{$item['id']}\" class=\"edit\">{$edit}</a> <a href=\"{$base}/{$taxonomy}/action/del/{$item['id']}\" class=\"delete\">{$delete}</a></td></tr>";
                }
                if(isset($item['children']) && is_array($item['children']))
                    $html .= $this->create_html($item['children'],$lang,$type,$dept+1);

            }
        }
        return $html;
    }

    /**
     * 新增属性
     *
     * @access public
     * @return StatusArray
     */
    public function insert($options = array()){
        $default = array(
            'slug' => '',
            'name' => '',
            'taxonomy' => 'tag',
            'parent_id' => 0,
            'desc' => '',
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

        if($this->check_exist($options['slug'])>0)
            return array('status'=>0,'msg'=>'already_exist');


        $status = $this->_CI->db->insert('terms',$options);
        if(! $status)
            return array('status'=>0,'msg'=>'sql_error');
        return array('status'=>1,'msg'=>'insert_success');
    }

    /**
     * 检测是否存在
     *
     * @access public
     * @return int
     */
    public function check_exist($slug = false,$id = false)
    {
        $this->_CI->db->select('count(*) as count')->from('terms')
            ->where('slug',$slug)
        ;
        if($id)
            $this->_CI->db->where('id <>',$id);
        $result = $this->_CI->db->get()->row_array();
        return $result['count'];
    }

    /**
     * 更新属性
     *
     * @access public
     * @return StatusArray
     */
    public function update($options = array()){
        $default = array(
            'id' => 0,
            'slug' => '',
            'name' => '',
            'taxonomy' => 'tag',
            'parent_id' => 0,
            'desc' => '',
            'updated_at' => date("Y-m-d H:i:s")
        );
        if( ! $this->_required(array('id','slug','name'),$options)){
            return array('status'=>0,'msg'=>'param_missing');
        }
        $options['name'] = encode_json($options['name']);
        $options = $this->_default($default,$options);
        if(is_numeric($options['slug']))
            return array('status'=>0,'msg'=>'no_numeric');

        if($this->check_exist($options['slug'],$options['id'])>0)
            return array('status'=>0,'msg'=>'already_exist');

        $status = $this->db->where('id',$options['id'])->update('terms',$options);
        if(!$status)
            return array('status'=>0,'msg'=>'sql_error');
        return array('status'=>1,'msg'=>'update_success');
    }
}