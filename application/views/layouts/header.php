<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?><!doctype html>
<!--[if lt IE 9 ]><html class="no-js ie ie6" lang="zh-CN"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie ie9" lang="zh-CN"> <![endif]-->
<!--[if !IE]><!--><html class="no-js" lang="zh-CN"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($lang->line($page)?$lang->line($page).' - ':' ').$site_name.' - Powered by Willog' ?></title>
    <link rel="stylesheet" href="<?=base_url('/assets/css/normalize.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/foundation.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/dashboard.min.css')?>">
</head>
<body>
<div id="container">
    <div class="sticky">
        <nav class="top-bar ">
            <ul class="title-area">
                <li class="name"></li>
                <li class="toggle-topbar menu-icon"><a href="#"><span><?= $lang->line('dashboard')?></span></a></li>
            </ul>


            <section class="top-bar-section">
                <!-- Right Nav Section -->
                <ul class="right">
                    <li class="divider"></li>
                    <li class=""><a href="/grid.php">Features</a></li>
                    <li class="divider"></li>
                    <li class=""><a href="/templates.php">Add-ons</a></li>
                    <li class="divider"></li>
                    <li class=""><a href="/case-jacquelinewest.php">Case Studies</a></li>
                    <li class="divider"></li>
                    <li class=""><a href="/docs/">Docs</a></li>
                    <li class="divider"></li>
                    <li class=""><a href="/training.php">Training</a></li>
                    <li class="divider"></li>
                    <li class="has-form">
                        <a href="http://foundation.zurb.com/docs" class="button">Getting Started</a>
                    </li>
                </ul>
            </section></nav>
    </div>


    <div class="pure-menu-link">
        <a href="#menu" id="menuLink"><span></span></a>
    </div>

    <div class="pure-u" id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="<?= base_url('/')?>"><?= $site_name ?></a>
            <ul>
                <li <?= $nav_index==1?' class="selected"':'' ?>>
                    <a href="<?= base_url('/admin') ?>"><?= $lang->line('dashboard') ?></a>
                </li>
                <li <?= $nav_index==15?' class="selected"':'' ?>>
                    <a href="<?= base_url('/admin/categories') ?>"><?= $lang->line('categories') ?></a>
                </li>
                <li class="menu-item-divided<?= $nav_index==81?' selected':'' ?>">
                    <a href="<?= base_url('/admin/users')?>"><?= $lang->line('users') ?></a>
                </li>
                <li <?= $nav_index==82?' class="selected"':'' ?>>
                    <a href="<?= base_url('/admin/users/add') ?>"><?= $lang->line('user_add') ?></a>
                </li>
            </ul>
        </div>
    </div>
    <div id="main">