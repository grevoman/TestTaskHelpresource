<?php

use common\modules\company\models\CompanyType;
use common\modules\company\models\Industry;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(CompanyType::asDropdown(), ['prompt' => 'Ничего не выбрано']) ?>

    <?= $form->field($model, 'industry_id')->dropDownList(Industry::asDropdown(), ['prompt' => 'Ничего не выбрано']) ?>

    <?= $form->field($model, 'inn')->input('number') ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->input('tel') ?>

    <?= $form->field($model, 'email')->input('email') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
