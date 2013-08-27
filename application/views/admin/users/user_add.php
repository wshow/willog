<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-16 23:15
 * File:    user_add.php
 */
?>

<div class="large-12 columns">
    <form class="custom" action="<?= base_url('admin/users/action/add') ?>" method="post">
        <fieldset>
            <legend><?= $lang->line('add') ?></legend>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

            <div class="large-12 columns">
                <label><?= $lang->line('username') ?></label>
                <input class="disabled" type="text" name="u[username]" placeholder="username" value="">
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('nick') ?></label>
                <input type="text" name="u[nickname]" placeholder="nickname" value="">
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('email') ?></label>
                <input type="email" name="u[email]" placeholder="email" value="">
            </div>

            <div class="large-12 columns">
                <label><?= $lang->line('password') ?></label>
                <input type="password" name="u[password]" placeholder="password">
            </div>

            <div class="large-12 columns">
                <input type="submit" value="<?= $lang->line('submit') ?>" class="button small round">
            </div>
        </fieldset>
    </form>
</div>