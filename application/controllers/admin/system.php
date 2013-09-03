<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 21:30
 * File:    system.php
 */

require_once('Admin_Controller.php');

class System extends Admin_Controller {
    public function index()
    {
        $this->load->helper('directory');
        $this->data['languages'] = directory_map('./application/language',1);
        $this->load->model('m_options');
        $this->data['options'] = $this->m_options->get();

        $this->admin_view(array('folder'=>'system','page'=>'system','index'=>91));
    }

    public function save()
    {
        $options = $this->input->post('o');
        if(isset($options['site_langs']))
            $options['site_langs'] = implode(',',$options['site_langs']);
        if(isset($options['sys_langs']))
            $options['sys_langs'] = encode_json($options['sys_langs']);

        foreach($options as $key=>$value){
            $temp = array();
            $temp['table'] = 'options';
            $temp['by'] = 'key';
            $temp['key'] = $key;
            $temp['value'] = is_array($value)?encode_json($value):$value;
            $temp['autoload'] = 'yes';
            $this->m_db->update_or_insert($temp);
        }
        redirect(base_url('/admin/system'));
    }
}
/* End of file system.php */
/* Location: ./application/controllers/admin/system.php */