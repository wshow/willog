<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * willog
 * Author:  willin
 * Created: 2013-08-16 22:38
 * File:    users.php
 */
if($users['status']==1) :
    $cur_page = (int)$users['data']['page_now'];
?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>UN</th>
                <th>NC</th>
                <th>EM</th>
                <th>OP</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="5">
                    <?= $users['data']['page_now'] ?> / <?= $users['data']['page_count'] ?>
                        <?php if($cur_page>1) : ?>
                            <a href="<?= base_url('/admin/users/?page='.($cur_page-1)) ?>">上一页</a>
                        <?php endif;
                        if($cur_page<$users['data']['page_count']):?>
                            <a href="<?= base_url('/admin/users/?page='.($cur_page+1)) ?>">下一页</a>
                        <?php endif;?>
                </th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach($users['data']['result'] as $user): ?>
                <tr>
                    <td>
                        <?= $user['id'] ?>
                    </td>
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
                        <a href="<?= base_url('/admin/users/edit?id='.$user['id']) ?>">修改</a>
                        <?php if($user['id']>1): ?>
                            <a href="<?= base_url('/admin/users/action/del?u[id]='.$user['id']) ?>">删除</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif;?>