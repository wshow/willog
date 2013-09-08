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
<script type="text/javascript" src="<?= base_url('/assets') ?>/js/posts.js"></script>
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
            "save table contextmenu directionality paste textcolor"
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor"

    });
</script>

<div class="large-12 columns">
    <div class="large-9 columns">
        <noscript>
            <div data-alert="" class="alert-box round">
                <?= $lang->line('need_js') ?>
                <a href="" class="close">×</a>
            </div>
        </noscript>
        <form id="post_form" method="post">
            <div class="editors">
                <ul id="editor_switch" class="button-group radius">
                    <?php foreach($langs as $l): ?>
                        <li>
                            <a href="#<?= $l ?>" data-lang="<?= $l ?>" class="small button <?= ($l==$cur_lang)?'current':'secondary' ?>">
                                <?= isset($sys_langs[$l])?$sys_langs[$l]:$l ?>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>
                <textarea id="tinymce" data-lang="<?= $cur_lang ?>"></textarea>
                <div class="hide-">
                    <?php foreach($langs as $l): ?>
                        <textarea name="p[content][<?= $l ?>]" id="content_<?= $l ?>"></textarea>
                    <?php endforeach; ?>
                </div>
            </div>
            <input type="button" class="button" id="post_submit">
        </form>
    </div>
    <div class="large-3 columns">

    </div>
</div>