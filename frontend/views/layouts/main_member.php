<?php

use yii\helpers\Html;

\frontend\assets\AppBdsHdAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->render('header') ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= frontend\modules\home\components\page\HeaderMenuWidgets::widget() ?>
        <content>
            <div class="container single" id="dangnhap">
                <main id="main-content">
                    <div class="row">
                        <?= $content ?>
                    </div>
                </main>
            </div>
        </content>
    <?= \frontend\modules\home\components\page\FooterWidgets::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>