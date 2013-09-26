<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
        </div>
        <aside id="sidebar">
            <nav class="widget">
                <h3><?= $lang['languages'] ?></h3>
                <div>
                    <?= $this->willog->w_get_language_links($cur_lang) ?>
                </div>
            </nav>
            <div class="widget hide-for-small">
                <h3><?= $lang['qrcode']?></h3>
                <div class="qrcode center">
                    <p><img class="radius" src="<?=$opt['cdn_url']?>themes/<?=$opt['site_theme']?>/images/qr.png" alt="qr code"></p>
                    <p><?=$lang['qrdesc']?></p>
                </div>
            </div>
            <div class="widget">
                <h3><?= $lang['archives'] ?></h3>
                <div>
                    <?= $this->willog->w_get_archives() ?>
                </div>
            </div>
        </aside>