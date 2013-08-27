<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 17:05
 * File:    city_edit.php
 */
?>
<form action="<?= base_url('admin/cities/action/edit') ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

    <input name="t[slug]" placeholder="Slug" value="<?= $city['slug']?>">

    <?php if(is_json($city['name'])) $city['name'] = json_decode($city['name'],true);
    foreach($langs as $lang):?>
        <input name="t[name][<?= $lang ?>]" placeholder="Name(<?= $lang ?>)"  value="<?= isset($city['name'][$lang])?$city['name'][$lang]:'' ?>">
    <?php endforeach;?>

    <select name="t[parent_id]">
        <option value="0">-</option>
        <?= $options ?>
    </select>

    <input name="t[desc]" maxlength="255" placeholder="Desc" value="<?= $city['desc']?>">

    <input type="submit">
</form>