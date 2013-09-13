<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-09-04 23:16
 * File:    posts.php
 */
$cur_page = (int)$posts['data']['page_now'];
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
                <?= $posts['data']['count'] ?> | <?= $posts['data']['page_now'] ?> / <?= $posts['data']['page_count'] ?>
                <?= $this->paginators->output() ?>
            </th>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach($posts['data']['result'] as $post): ?>
            <tr>
                <td>
                    <?= $post['name'] ?>
                </td>
                <td>
                    Test
                </td>
                <td>
                    Test
                </td>
                <td>
                    <a href="<?= base_url('/admin/users/edit/'.$post['id']) ?>"><?= $lang->line('edit') ?></a>
                    <a href="<?= base_url('/admin/users/action/del/'.$post['id']) ?>"><?= $lang->line('delete') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>