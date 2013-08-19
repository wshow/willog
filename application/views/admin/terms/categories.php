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
                <th>SL</th>
                <th>NM</th>
                <th>DE</th>
                <th>OP</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="5">
                    <?= $users['data']['count'] ?> | <?= $users['data']['page_now'] ?> / <?= $users['data']['page_count'] ?>
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
                        <?= $user['slug'] ?>
                    </td>
                    <td>
                        <?= $user['name'] ?>
                    </td>
                    <td>
                        <?= $user['desc'] ?>
                    </td>
                    <td>
                        <a href="<?= base_url('/admin/categories/edit?id='.$user['id']) ?>">修改</a>
                        <a href="<?= base_url('/admin/terms/action/del?u[id]='.$user['id']) ?>">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif;?>