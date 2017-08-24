<?php
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
        <?= $content ?>
    <?= \frontend\modules\home\components\page\FooterWidgets::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>