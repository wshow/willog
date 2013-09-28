<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <?php include_once('sidebar.php');?>
    </main>
    <footer id="footer">
        <p><a href="<?= $base_url ?>"><?=$site_name?></a> &copy; <?=date('Y')?> All Rights Reserved. Theme by <a href="http://willin.org">Willin Wang</a>. Powered by <a href="http://now.willin.org" target="_blank">Willog</a>.</p>
        <p><small>Mem used: {memory_usage}, Loaded in {elapsed_time}s, {total_queries} queries</small></p>
    </footer>
    <div class="hide">
        <img src="<?= base_url() ?>themes/<?=$opt['site_theme']?>/images/bg.jpg" id="bgb">
    </div>
</div><!--End Wrapper-->
<canvas id="canvas"></canvas>
<div id="loading"></div>
</body>
</html>