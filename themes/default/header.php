<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once('functions.php');?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="shorcut icon" href="<?=$opt['cdn_url']?>favicon.ico" type="image/x-ico" />
    <link rel="stylesheet" href="<?=$opt['cdn_url']?>themes/<?=$opt['site_theme']?>/style.css">
    <meta name="keywords" content="<?= $opt['site_key'][$cur_lang] ?>">
    <meta name="description" content="<?= $opt['site_desc'][$cur_lang] ?>">
    <title><?= isset($title)?$title.' - ':'' ?> <?=$site_name?> - <?=$opt['site_desc'][$cur_lang]?></title>
    <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
    <script>window.jQuery || document.write(unescape('%3Cscript src="<?=$opt['cdn_url']?>themes/<?=$opt['site_theme']?>/js/jquery.min.js"%3E%3C/script%3E'))</script>
    <script type="text/javascript" src="<?=$opt['cdn_url']?>themes/<?=$opt['site_theme']?>/js/default.min.js"></script>
</head>
<body class="<?=is_mobile()?'mobile':'desktop'?>">
<div class="wrapper">
    <header>
        <h2><?=$opt['site_desc'][$cur_lang]?></h2>
        <h1><a href="#"><?=$site_name?></a></h1>
        <h2 class="bottom"><span class="hide">相距??，</span>不管还要多久，最后我会在你身边。</h2>
    </header>
    <main id="main">
        <div id="content">
            test test test test test test test test test test test test test test test test test test test test test
            <a href="#">test </a> test test test test test test test test test test test