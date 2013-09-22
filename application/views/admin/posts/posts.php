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
            <th><?= $lang->line('title') ?></th>
            <th><?= $lang->line('category') ?></th>
            <th><?= $lang->line('city') ?></th>
            <th><?= $lang->line('tag') ?></th>
            <th><?= $lang->line('views') ?> / <?= $lang->line('comments') ?></th>
            <th><?= $lang->line('operation') ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th colspan="6">
                <?= $posts['data']['count'] ?> | <?= $posts['data']['page_now'] ?> / <?= $posts['data']['page_count'] ?>
                <?= $this->paginators->output() ?>
            </th>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach($posts['data']['result'] as $post): ?>
            <tr>
                <td>
                    <?= $post['name'][$cur_lang] ?>
                </td>
                <td>
                    <?php if(isset($post['category'])): ?>
                        <?php foreach($post['category'] as $item): ?>
                            <a href="#<?= $item['id'] ?>"><?= $item['name'][$cur_lang] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(isset($post['city'])): ?>
                        <?php foreach($post['city'] as $item): ?>
                            <a href="#<?= $item['id'] ?>"><?= $item['name'][$cur_lang] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(isset($post['tag'])): ?>
                        <?php foreach($post['tag'] as $item): ?>
                            <a href="#<?= $item['id'] ?>"><?= $item['name'][$cur_lang] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?= $post['views'] ?> / <?= $post['comments'] ?>
                </td>
                <td>
                    <a href="<?= base_url('/admin/posts/edit/'.$post['id']) ?>"><?= $lang->line('edit') ?></a>
                    <a href="<?= base_url('/admin/posts/action/del/'.$post['id']) ?>"><?= $lang->line('delete') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>