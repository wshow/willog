<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 21:32
 * File:    system.php
 */
if(isset($options['site_langs']))
    $options['site_langs'] = explode(',',$options['site_langs']);
 ?>

<div class="large-12 columns">
    <form class="custom" action="<?= base_url('admin/system/save') ?>" method="post">
        <fieldset>
            <legend><?= $lang->line('system') ?></legend>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

            <div class="large-12 columns">
                <label><?= $lang->line('site_name') ?></label>
                <?php foreach($langs as $l):?>
                    <input type="text" name="o[site_name][<?= $l ?>]" placeholder="Site Name(<?= $l ?>)" value="<?= isset($options['site_name'][$l])?$options['site_name'][$l]:'' ?>">
                <?php endforeach; ?>
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('site_desc') ?></label>
                <?php foreach($langs as $l):?>
                    <input type="text" name="o[site_desc][<?= $l ?>]" placeholder="Site Description(<?= $l ?>)" value="<?= isset($options['site_desc'][$l])?$options['site_desc'][$l]:'' ?>">
                <?php endforeach; ?>
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('site_key') ?></label>
                <?php foreach($langs as $l):?>
                    <input type="text" name="o[site_key][<?= $l ?>]" placeholder="Site Keywords(<?= $l ?>)" value="<?= isset($options['site_key'][$l])?$options['site_key'][$l]:'' ?>">
                <?php endforeach; ?>
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('site_lang') ?></label>
                <select name="o[site_lang]">
                    <?php foreach($options['site_langs'] as $l):?>
                        <option value="<?= $l ?>" <?= $l==$options['site_lang']?'seletecd="seletecd"':'' ?>><?= isset($options['sys_langs'][$l])?$options['sys_langs'][$l]:$l ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="large-12 columns">
                <label><?= $lang->line('site_langs') ?></label>

                <?php foreach($languages as $l): ?>
                    <label for="<?= $l ?>">
                        <input <?=(in_array($l,$options['site_langs']))?'checked="checked"':''?> type="checkbox" name="o[site_langs][]" id="<?= $l ?>" value="<?= $l ?>" class="inline">
                        <input type="text" value="<?= isset($options['sys_langs'][$l])?$options['sys_langs'][$l]:$l ?>" name="o[sys_langs][<?= $l ?>]" class="max120 inline">

                    </label>
                <?php endforeach; ?>
            </div>

            <div class="large-12 columns">
                <input type="submit" value="<?= $lang->line('submit') ?>" class="button small round">
            </div>
        </fieldset>
    </form>
</div>