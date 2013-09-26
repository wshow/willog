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
    ),
    'en'=>array(
        'languages' => 'Languages',
        'qrcode' => 'QR Code',
        'qrdesc' => 'Fit with mobile and pad',
        'archives' => 'Archives',
    )
);
$lang = $language[$cur_lang];