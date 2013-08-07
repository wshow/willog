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
            <div class="text-center col-lg-6 col-lg-offset-3">
                <h1 class="logo">Willog</h1>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-lg-offset-2 col-lg-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value=" Login " >
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- /container -->

    <div class="scripts">
        <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('/assets/js/responsive-modernizr.js')?>"></script>
        <script type="text/javascript">window.jQuery || document.write('<script src="<?=base_url('/assets/js/jquery-1.10.2.min.js')?>">\x3C/script>')</script>
    </div>
</body>
</html>