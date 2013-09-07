<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-04 23:16
 * File:    post_add.php
 */
 ?>
<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="<?= base_url('/assets') ?>/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#tinymce",
        height:400,
        <?php if($cur_lang=='cn'): ?>
        language:'zh_CN',
        <?php endif; ?>
        plugins: [
            "advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
            "save table contextmenu directionality template paste textcolor"
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor"

    });
</script>

<div class="large-12 columns">
    <div class="large-9 columns">
        <form method="post">
            <textarea id="tinymce"></textarea>
        </form>
    </div>
    <div class="large-3 columns">

    </div>
</div>