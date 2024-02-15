<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Client $model */
/** @var array $clubs */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->radioList(['male' => 'Male', 'female' => 'Female']) ?>

    <?php $selectedClubs = ArrayHelper::map($model->getClubs()->all(), 'id', 'name'); ?>
    <?= $form->field($model, 'club_ids')
        ->label('Select Clubs')
        ->dropDownList($clubs,
            [
                'multiple' => 'multiple',
                'class' => 'form-control',
                'options' => array_map(function () {
                    return ['selected' => true];
                }, $selectedClubs),
            ]
        )
        ?>

    <?= $form->field($model, 'birth_date')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
