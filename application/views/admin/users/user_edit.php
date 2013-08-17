<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-17 00:06
 * File:    user_edit.php
 */
?>
<form action="<?= base_url('admin/users/action/edit') ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />

    <input type="text" name="u[username]" placeholder="username" value="<?= $user['username'] ?>" readonly>

    <input type="email" name="u[email]" placeholder="email" value="<?= $user['email'] ?>">

    <input type="text" name="u[nickname]" placeholder="nickname" value="<?=  $user['nickname'] ?>">

    <input type="password" name="u[password]" placeholder="password">

    <input type="submit">
</form>