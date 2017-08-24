<?php
use yii\helpers\Html;
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= Html::encode($this->title) ?></title>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<!-- javascript -->
<?php $this->head() ?>
<?php
$this->registerCssFile(Yii::getAlias("@web") . '/themes/bdshd/css/custom.css');
?>