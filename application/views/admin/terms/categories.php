<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-16 22:38
 * File:    users.php
 */
?>
<div class="arow">
    <div class="large-6 columns">
        <form class="custom" method="post" action="<?=base_url('/admin/categories/action/add')?>">
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
                    <label><?= $lang->line('parent') ?></label>
                    <select name="t[parent_id]">
                        <option value="0"><?= $lang->line('none') ?></option>
                        <?= $options ?>
                    </select>
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

            <tbody>
            <?= $categories ?>
            </tbody>
        </table>
    </div>

    <div class="clear"></div>
</div>
