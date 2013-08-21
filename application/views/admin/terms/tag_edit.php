<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-21 20:56
 * File:    tag_edit.php
 */
?>
<form action="<?= base_url('admin/tags/action/edit') ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

    <input name="t[slug]" placeholder="Slug" value="<?= $tag['slug']?>">

    <?php if(is_json($tag['name'])) $tag['name'] = json_decode($tag['name'],true);
    foreach($langs as $lang):?>
        <input name="t[name][<?= $lang ?>]" placeholder="Name(<?= $lang ?>)"  value="<?= isset($tag['name'][$lang])?$tag['name'][$lang]:'' ?>">
    <?php endforeach;?>

    <input name="t[desc]" maxlength="255" placeholder="Desc" value="<?= $tag['desc']?>">

    <input type="submit">
</form>