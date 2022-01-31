<?php

use common\modules\company\models\Company;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reportForm\models\MonthlyReport */
/* @var $importFileForm \frontend\modules\report\forms\ImportFileForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monthly-report-form">
    <div class="card">
        <h5 class="card-header"><?= $importFileForm->getAttributeLabel('reportFile') ?> (<?= Html::a('Скачать шаблон', ['@web/static/report_form.xlsx']) ?>)</h5>
        <div class="card-body">
            <?php $importForm = ActiveForm::begin(); ?>
            <?= $importForm->field($importFileForm, 'reportFile')->fileInput(['accept' => '.xlsx, .xls, .csv, .ods']
            )->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Импортировать', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <br>

    <div class="card">
        <h5 class="card-header">Ввод отчёта вручную</h5>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'company_id')->dropDownList(
                Company::asDropdown(),
                ['prompt' => 'Ничего не выбрано']
            ) ?>

            <?= $form->field($model, 'workers')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'taxes')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'energy_amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'energy_organization')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
