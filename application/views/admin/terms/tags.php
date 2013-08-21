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
<form method="post" action="<?=base_url('/admin/tags/action/add')?>">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

    <input name="t[slug]" placeholder="Slug">

    <?php foreach($langs as $lang):?>
         <input name="t[name][<?= $lang ?>]" placeholder="Name(<?= $lang ?>)">
    <?php endforeach;?>

    <input name="t[desc]" maxlength="255" placeholder="Desc">

    <input type="submit">
</form>
<table class="large-12 columns">
    <thead>
    <tr>
        <th>Name</th>
        <th>Slug</th>
        <th>Desc</th>
        <th>Count</th>
        <th>Operate</th>
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
                <?php if(is_json($tag['name'])) $tag['name']=json_decode($tag['name']); ?>
                <?= isset($tag['name']->$cur_lang)?$tag['name']->$cur_lang:'' ?>
            </td>
            <td>
                <?= $tag['slug'] ?>
            </td>
            <td>
                <?= $tag['desc'] ?>
            </td>
            <td>
                <?= $tag['count'] ?>
            </td>
            <td>
                <a href="<?= base_url('/admin/tags/edit/'.$tag['id']) ?>">修改</a>
                <a href="<?= base_url('/admin/tags/action/del/'.$tag['id']) ?>">删除</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


