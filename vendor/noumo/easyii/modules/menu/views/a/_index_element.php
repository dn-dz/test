<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<tr>
    <?php if(IS_ROOT) : ?>
        <td><?= $item->primaryKey ?></td>
    <?php endif; ?>
    <td style="<?= $padding ? 'padding-left: '.$padding.'px' : '' ?>">
        <?php if(!empty($children)) : ?>
            <i class="caret"></i>
        <?php endif; ?>
        <a href="<?= Url::to(['/admin/'.$module.'/a/edit', 'id' => $item->primaryKey]) ?>"><?= $item->title ?></a></td>
    <?php if(IS_ROOT) : ?>
        <td><?= $item->url ?></td>
        <td><?= $item->menu_position ?></td>

        <td><a href="<?= Url::to(['/admin/'.$module.'/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('easyii', 'Delete item')?>"></a></td>
    <?php endif; ?>
</tr>