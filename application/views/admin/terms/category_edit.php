<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 17:02
 * File:    category_edit.php
 */
?>
<form action="<?= base_url('admin/categories/action/edit') ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

    <input name="t[slug]" placeholder="Slug" value="<?= $category['slug']?>">

    <?php if(is_json($category['name'])) $category['name'] = json_decode($category['name'],true);
    foreach($langs as $lang):?>
        <input name="t[name][<?= $lang ?>]" placeholder="Name(<?= $lang ?>)"  value="<?= isset($category['name'][$lang])?$category['name'][$lang]:'' ?>">
    <?php endforeach;?>

    <select name="t[parent_id]">
        <option value="0">-</option>
        <?= $options ?>
    </select>

    <input name="t[desc]" maxlength="255" placeholder="Desc" value="<?= $category['desc']?>">

    <input type="submit">
</form>