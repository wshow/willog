<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-02 18:11
 * File:    languages.php
 */
if(isset($options['site_langs']))
    $options['site_langs'] = explode(',',$options['site_langs']);
?>

<div class="large-12 columns">
    <form class="custom" action="<?= base_url('admin/system/save/languages') ?>" method="post">
        <fieldset>
            <legend><?= $lang->line('languages') ?></legend>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

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

                <?php foreach($langs as $l): ?>
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