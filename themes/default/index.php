<?php defined('BASEPATH') OR exit('No direct script access allowed');
    include_once('header.php');
?>

    <ul class="timeline">
        <?php foreach($posts['data']['result'] as $post):?>
            <li>
                <div class="meta">
                    <time datetime="<?=$post['created_at']?>">
                        <?=date('Y-m-d',strtotime($post['created_at']))?>
                    </time>
                    <address><?=$post['terms']['city']?></address>
                </div>
                <div class="device <?=$post['device']?>"></div>
                <div class="mrright">
                    <article>
                        <cite><?=$post['address']?></cite>
                        <h2><a href="<?=$base_url.$post['slug']?>"><?=$post['name']?></a></h2>
                        <section>
                            <?= $post['expert'] ?>
                        </section>
                        <section class="meta">
                            <?= $post['meta']?>
                        </section>
                    </article>
                </div>
            </li>
        <?php endforeach;?>
    </ul>
    <div class="navigation" data-index="2" data-total="0">
        <noscript>
            <?= $this->paginators->output() ?>
        </noscript>
    </div>
<?php include_once('footer.php');?>