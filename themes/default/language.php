<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-26 19:12
 * File:    language.php
 */
$language = array(
    'cn'=>array(
        'languages' => '语言切换',
        'qrcode' => '二维码',
        'qrdesc' => '支持移动设备和平板',
        'archives' => '归档',
        'distance' => '与你相距',
        'category' => '分类',
        'tag' => '标签',
        'created' => '发表于',
        'views' => '浏览',
        'comments' => '评论',
        'cities' => '城市',
        'tags' => '标签云',
        'categories' => '分类',
    ),
    'en'=>array(
        'languages' => 'Languages',
        'qrcode' => 'QR Code',
        'qrdesc' => 'Fit with mobile and pad',
        'archives' => 'Archives',
        'distance' => 'Away by ',
        'category' => 'Category under',
        'tag' => 'Tagged in',
        'created' => 'Created at',
        'views' => 'Views',
        'comments' => 'Comments',
        'cities' => 'Cities',
        'tags' => 'Tags',
        'categories' => 'Categories',

    )
);
$lang = $language[isset($cur_lang)?$cur_lang:$this->data['cur_lang']];