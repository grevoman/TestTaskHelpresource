<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\reportForm\models\MonthlyReport */
/* @var $importFileForm \frontend\modules\report\forms\ImportFileForm */

$this->title = 'Добавить отчёт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'importFileForm' => $importFileForm,
    ]) ?>

</div>
