<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-04 23:26
 * File:    post_edit.php
 * TODO: 差分类、时间的数据绑定
 */
$post['content']=json_decode($post['content'],true);
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
            "advlist autolink link image lists charmap preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen  insertdatetime nonbreaking",
            "save table contextmenu directionality paste textcolor"
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview | forecolor backcolor"

    });
</script>

<div class="large-12 columns">
    <form action="<?= base_url('/admin/posts/action/edit/'.$post['id']) ?>" id="post_form" method="post" class="custom">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
        <input type="hidden" name="p[device]" value="<?=is_mobile()?'mobile':'desktop'?>">
        <div class="large-9 columns">
            <noscript>
                <div data-alert="" class="alert-box round">
                    <?= $lang->line('need_js') ?>
                    <a href="" class="close">×</a>
                </div>
            </noscript>

            <div class="title">
                <label><?= $lang->line('title') ?></label>
                <?php $post['name']=json_decode($post['name'],true);foreach($langs as $l): ?>
                    <input type="text" name="p[name][<?= $l ?>]" value="<?= isset($post['name'][$l])?$post['name'][$l]:'' ?>" placeholder="Title (<?= $l ?>)">
                <?php endforeach; ?>
            </div>
            <div class="terms">
                <div class="collapse">
                    <div class="large-6 columns">
                        <label><?= $lang->line('category') ?></label>
                        <div class="bkg">
                            <ul class="categories">
                                <?= $categories ?>
                            </ul>
                        </div>
                    </div>

                    <div class="large-6 columns">
                        <label><?= $lang->line('city') ?></label>
                        <select name="m[city]" id="city">
                            <option value=""><?= $lang->line('unselected') ?></option>
                            <?= $cities ?>
                        </select>
                        <script type="text/javascript">
                            var terms = '<?=$post['terms']?>'.split(',');
                        </script>
                        <label><?= $lang->line('tag') ?></label>
                        <div class="bkg">
                            <ul class="tags">
                                <?= $tags ?>
                            </ul>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
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
                <textarea id="tinymce" data-lang="<?= $cur_lang ?>"><?= isset($post['content'][$cur_lang])?$post['content'][$cur_lang]:'' ?></textarea>

                <div class="hide">
                    <?php foreach($langs as $l): ?>
                        <textarea name="p[content][<?= $l ?>]" id="content_<?= $l ?>"><?=  isset($post['content'][$l])?$post['content'][$l]:'' ?></textarea>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <div class="large-3 columns">
            <div class="slug">
                <label for="slug"><?= $lang->line('slug') ?></label>
                <input type="text" data-id="<?= $post['id'] ?>" id="slug" name="p[slug]" placeholder="Slug" value="<?= $post['slug'] ?>">
                <span class="hide">已经存在</span>
            </div>

            <div class="map">
                <label for="search_place"><?= $lang->line('geolocation') ?></label>
                <div class="row collapse">
                    <div class="small-9 columns">
                        <input type="text" id="search_place" placeholder="Search">
                    </div>
                    <div class="small-3 columns">
                        <input id="search_place_button" type="button" class="button postfix" value="<?= $lang->line('search') ?>">
                    </div>
                </div>

                <div id="map-canvas"></div>
                <input type="hidden" id="lat" name="p[lat]">
                <input type="hidden" id="lng" name="p[lng]">
            </div>
            <div class="address">
                <label><?= $lang->line('address') ?></label>
                <?php $post['address']=json_decode($post['address'],true);foreach($langs as $l): ?>
                    <input type="text" name="p[address][<?= $l ?>]" placeholder="Address (<?= $l ?>)" value="<?= isset($post['address'][$l])?$post['address'][$l]:'' ?>">
                <?php endforeach; ?>
            </div>

            <div class="thumb">
                <label><?= $lang->line('thumb') ?></label>
                <input type="text" name="p[thumb]" placeholder="Thumb" value="<?= $post['thumb'] ?>">
            </div>

            <div class="created_at">
                <label><?= $lang->line('created_at') ?></label>
                <input type="text" name="p[created_at]" value="<?= $post['created_at'] ?>">
            </div>

            <div class="buttons row collapse">
                <div class="small-6 columns">
                    <input type="button" class="small button secondary expand" id="post_draft" value="<?= $lang->line('save_draft') ?>">
                </div>
                <div class="small-6 columns">
                    <input type="button" class="small button success expand" id="post_submit" value="<?= $lang->line('publish') ?>">
                </div>
            </div>
        </div>
    </form>
</div>