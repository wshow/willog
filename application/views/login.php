<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?><!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" lang="zh-CN"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="zh-CN"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="zh-CN"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" lang="zh-CN"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="zh-CN"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title><?= ($title?$title.' - ':' ').$site_name.' - Powered by Willog' ?></title>
</head>
<body>
    <?php
    echo $this->options->get('site_name','cn');
    echo '<hr>';
    var_dump($this->options->get());
    //code.jquery.com/jquery.min.js
    ?>
</body>
</html>