<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 17:02
 * File:    category_edit.php
 */
?>
<div class="large-12 columns">

    <form class="custom" method="post" action="<?=base_url('/admin/categories/action/edit')?>">
        <fieldset>
            <legend><?= $lang->line('edit') ?></legend>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
            <input type="hidden" name="t[id]" value="<?= $category['id'] ?>">

            <div class="large-12 columns">
                <label><?= $lang->line('slug') ?></label>
                <input type="text" name="t[slug]" placeholder="Slug" value="<?= $category['slug']?>">
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('name') ?></label>
                <?php if(is_json($category['name'])) $category['name'] = json_decode($category['name'],true);
                 foreach($langs as $l):?>
                    <input type="text" name="t[name][<?= $l ?>]" placeholder="Name(<?= $l ?>)" value="<?= isset($category['name'][$l])?$category['name'][$l]:'' ?>">
                <?php endforeach;?>
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('parent') ?></label>
                <select name="t[parent_id]">
                    <option value="0"><?= $lang->line('none') ?></option>
                    <?= $options ?>
                </select>
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('desc') ?></label>
                <input type="text" name="t[desc]" maxlength="255" placeholder="Desc" value="<?= $category['desc']?>">
            </div>

            <div class="large-12 columns">
                <input type="submit" value="<?= $lang->line('submit') ?>" class="button small round">
            </div>
        </fieldset>
    </form>
</div>
