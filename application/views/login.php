<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?><!doctype html>
<!--[if lt IE 9 ]><html class="no-js ie ie6" lang="zh-CN"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie ie9" lang="zh-CN"> <![endif]-->
<!--[if !IE]><!--><html class="no-js" lang="zh-CN"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($title?$title.' - ':' ').$site_name.' - Powered by Willog' ?></title>
    <link rel="stylesheet" href="<?=base_url('/assets/css/bootstrap.min.css')?>">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">...</div>
        </div>
        <form class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" class="input-block-level" placeholder="Email address" autofocus>
            <input type="password" class="input-block-level" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-large btn-primary btn-block" type="submit">Sign in</button>
        </form>

    </div> <!-- /container -->

    <div class="scripts">
        <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('/assets/js/responsive-modernizr.js')?>"></script>
        <script type="text/javascript">window.jQuery || document.write('<script src="<?=base_url('/assets/js/jquery-1.10.2.min.js')?>">\x3C/script>')</script>
    </div>
</body>
</html>