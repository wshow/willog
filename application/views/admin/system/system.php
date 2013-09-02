<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-27 21:32
 * File:    system.php
 */
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
                <input type="submit" value="<?= $lang->line('submit') ?>" class="button small round">
            </div>
        </fieldset>
    </form>
</div>