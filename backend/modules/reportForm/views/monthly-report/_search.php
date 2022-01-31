<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reportForm\models\search\MonthlyReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monthly-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'workers') ?>

    <?= $form->field($model, 'salary') ?>

    <?= $form->field($model, 'taxes') ?>

    <?= $form->field($model, 'energy_amount') ?>

    <?php // echo $form->field($model, 'energy_organization') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
