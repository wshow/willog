<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-16 22:38
 * File:    users.php
 */
$cur_page = (int)$users['data']['page_now'];
?>
<div class="large-12 columns">
    <table class="large-12 columns">
        <thead>
        <tr>
            <th><?= $lang->line('username') ?></th>
            <th><?= $lang->line('nick') ?></th>
            <th><?= $lang->line('email') ?></th>
            <th><?= $lang->line('operation') ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th colspan="5">
                <?= $users['data']['count'] ?> | <?= $users['data']['page_now'] ?> / <?= $users['data']['page_count'] ?>
                <?= $this->paginators->output() ?>
            </th>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach($users['data']['result'] as $user): ?>
            <tr>
                <td>
                    <?= $user['username'] ?>
                </td>
                <td>
                    <?= $user['nickname']?$user['nickname']:'-' ?>
                </td>
                <td>
                    <?= $user['email'] ?>
                </td>
                <td>
                    <a href="<?= base_url('/admin/users/edit/'.$user['id']) ?>"><?= $lang->line('edit') ?></a>
                    <?php if($user['id']>1): ?>
                        <a href="<?= base_url('/admin/users/action/del/'.$user['id']) ?>"><?= $lang->line('delete') ?></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>