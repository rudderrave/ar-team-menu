<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model arteam\menu\models\Menu */

$this->title = Yii::t('arteam', 'Create {item}', ['item' => Yii::t('arteam/menu', 'Menu')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('arteam/menu', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-create">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>