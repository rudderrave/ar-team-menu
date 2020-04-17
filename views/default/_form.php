<?php

use arteam\helpers\Html;
use arteam\widgets\ActiveForm;
use arteam\widgets\LanguagePills;

/* @var $this yii\web\View */
/* @var $model arteam\models\Menu */
/* @var $form arteam\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'menu-form',
        'validateOnBlur' => false,
    ])
    ?>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php if ($model->isMultilingual()): ?>
                        <?= LanguagePills::widget() ?>
                    <?php endif; ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?php if ($model->isNewRecord): ?>
                        <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">

                        <?php if (!$model->isNewRecord): ?>
                            <div class="form-group">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['id'] ?> :
                                </label>
                                <span><?= $model->id ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <?php if ($model->isNewRecord): ?>

                                <?= Html::submitButton(Yii::t('arteam', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('arteam', 'Cancel'), ['/menu/default/index'], ['class' => 'btn btn-default']) ?>

                            <?php else: ?>

                                <?= Html::submitButton(Yii::t('arteam', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('arteam', 'Delete'), ['/menu/default/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-default',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]) ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
