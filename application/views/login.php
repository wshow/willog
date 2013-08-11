<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?><!doctype html>
<!--[if lt IE 9 ]><html class="no-js ie ie6" lang="zh-CN"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie ie9" lang="zh-CN"> <![endif]-->
<!--[if !IE]><!--><html class="no-js" lang="zh-CN"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($lang->line('title')?$lang->line('title').' - ':' ').$site_name.' - Powered by Willog' ?></title>
    <link rel="stylesheet" href="<?=base_url('/assets/css/normalize.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/foundation.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/dashboard.min.css')?>">
</head>
<body>

    <div class="container">
       <div class="row">
           <div class="large-6 large-offset-3 columns">
               <form id="loginform" method="post" action="<?= base_url('/admin/login/submit') ?>">
                   <h1 class="logo text-center"><a href="#">Willog</a></h1>
                   <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                   <div class="username">
                       <label for="username"><?= $lang->line('username') ?></label>
                       <input id="username" type="text" name="p[username]" placeholder="username" />
                   </div>
                   <div class="password">
                       <label for="password"><?= $lang->line('password') ?></label>
                       <input id="password" type="password" name="p[password]" placeholder="password" />
                   </div>
                   <div class="row">
                       <div class="small-3 columns">
                           <div class="switch">
                               <input id="off" name="p[remember]" type="radio" value="0" >
                               <label for="off" onclick="">Off</label>

                               <input id="on" name="p[remember]" type="radio" value="1" checked>
                               <label for="on" onclick="">On</label>
                               <span>&nbsp;</span>
                           </div>
                       </div>
                       <div id="remember" class="small-9 columns">
                           <?= $lang->line('remember') ?>
                           <?php if(isset($msg)): ?>
                               <span class="round alert label"><?= $msg ?></span>
                           <?php endif; ?>
                       </div>
                   </div>

                   <ul class="button-group round even-3">
                       <li><input type="submit" value="<?= $lang->line('login') ?>" class="button"></li>
                       <li><input type="reset" value="<?= $lang->line('reset') ?>" class="button"></li>
                       <li><input type="reset" value="<?= $lang->line('lost') ?>" class="button"></li>
                   </ul>
                   <div>


                   </div>
               </form>
           </div>
       </div>
    </div> <!-- /container -->

    <div class="scripts">
        <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('/assets/js/responsive-modernizr.js')?>"></script>
        <script type="text/javascript">window.jQuery || document.write('<script src="<?=base_url('/assets/js/jquery-1.10.2.min.js')?>">\x3C/script>')</script>
        <script type="text/javascript" src="<?=base_url('/assets/js/dashboard.min.js')?>"></script>
    </div>
</body>
</html>