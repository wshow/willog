<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-16 23:15
 * File:    user_add.php
 */
?>
<form action="<?= base_url('admin/users/action/add') ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

    <input type="text" name="u[username]" placeholder="username">

    <input type="email" name="u[email]" placeholder="email">

    <input type="password" name="u[password]" placeholder="password">

    <input type="submit">
</form>