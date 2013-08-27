<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-21 20:04
 * File:    tags.php
 */
$cur_page = (int)$tags['data']['page_now'];

?>
<div class="arow">
    <div class="large-6 columns">
        <form class="custom" method="post" action="<?=base_url('/admin/tags/action/add')?>">
            <fieldset>
                <legend><?= $lang->line('add') ?></legend>
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

                <div class="large-12 columns">
                    <label><?= $lang->line('slug') ?></label>
                    <input type="text" name="t[slug]" placeholder="Slug">
                </div>

                <div class="large-12 columns">
                    <label><?= $lang->line('name') ?></label>
                    <?php foreach($langs as $l):?>
                        <input type="text" name="t[name][<?= $l ?>]" placeholder="Name(<?= $l ?>)">
                    <?php endforeach;?>
                </div>

                <div class="large-12 columns">
                    <label><?= $lang->line('desc') ?></label>
                    <input type="text" name="t[desc]" maxlength="255" placeholder="Desc">
                </div>

                <div class="large-12 columns">

                    <input type="submit" value="<?= $lang->line('submit') ?>" class="button small round">
                </div>
            </fieldset>
        </form>
    </div>

    <div class="large-6 columns">
        <table class="large-12 columns">
            <thead>
            <tr>
                <th><?= $lang->line('name')?></th>
                <th><?= $lang->line('slug')?></th>
                <th><?= $lang->line('desc')?></th>
                <th><?= $lang->line('count')?></th>
                <th><?= $lang->line('operation')?></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th colspan="5">
                    <?= $tags['data']['count'] ?> | <?= $tags['data']['page_now'] ?> / <?= $tags['data']['page_count'] ?>
                    <?= $this->paginators->output() ?>
                </th>
            </tr>
            </tfoot>
            <tbody>
            <?php foreach($tags['data']['result'] as $tag): ?>
                <tr>
                    <td>
                        <?php if(is_json($tag['name'])) $tag['name']=json_decode($tag['name'],true); ?>
                        <?= isset($tag['name'][$cur_lang])?$tag['name'][$cur_lang]:'' ?>
                    </td>
                    <td>
                        <?= $tag['slug'] ?>
                    </td>
                    <td>
                        <?= $tag['desc'] ?>
                    </td>
                    <td>
                        <a href="<?= base_url('/admin/post?tag='.$tag['id'])?>"><?= $tag['count'] ?></a>
                    </td>
                    <td>
                        <a href="<?= base_url('/admin/tags/edit/'.$tag['id']) ?>">修改</a>
                        <a href="<?= base_url('/admin/tags/action/del/'.$tag['id']) ?>">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="clear"></div>
</div>



