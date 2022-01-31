<?php

use common\modules\company\models\Industry;
use common\modules\company\models\IndustryType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\company\models\Industry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="industry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(IndustryType::asDropdown(), ['prompt' => 'Ничего не выбрано']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
