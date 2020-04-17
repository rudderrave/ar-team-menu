<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model arteam\menu\models\Menu */

$this->title = Yii::t('arteam', 'Update "{item}"', ['item' => $model->title]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('arteam/menu', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', compact('model')) ?>

</div>
