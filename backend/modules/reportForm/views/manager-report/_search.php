<?php

use backend\modules\reportForm\assets\ManagerReportAsset;
use common\modules\company\models\Industry;
use common\modules\company\models\IndustryType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reportForm\models\search\MonthlyReportSearch */
/* @var $form yii\widgets\ActiveForm */

ManagerReportAsset::register($this);
?>

<div class="monthly-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'search-form',
        'options' => ['data' => ['default-action' => Url::to(['index'])]],
    ]); ?>

    <div class="input-group input-daterange">
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'reportRangeStart')
                    ->input('date', [
                        'class' => 'form-control',
                    ])
                    ->label(false) ?>
            </div>
            <div class="col input-group-addon">
                до
            </div>
            <div class="col">
                <?= $form->field($model, 'reportRangeEnd')
                    ->input('date', [
                        'class' => 'form-control',
                    ])
                    ->label(false) ?>
            </div>
            <div class="col">

            </div>
        </div>
    </div>

    <?= $form->field($model, 'companyRelation.industryRelation.type_id')->dropDownList(
        IndustryType::asDropdown(),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'companyRelation.industry_id')->dropDownList(
        Industry::asDropdown(),
        ['disabled' => true, 'prompt' => '', 'data-url' => Url::to(['/reportForm/manager-report/get-industries'])]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Показать отчёт', ['class' => 'btn btn-primary']) ?>
        <?= Html::a(
            'Экспорт в файл',
            ['/reportForm/manager-report/export'],
            ['id' => 'export-button', 'class' => 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
