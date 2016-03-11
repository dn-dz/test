<?php
$this->title = Yii::t('easyii/menu', 'Edit page');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>