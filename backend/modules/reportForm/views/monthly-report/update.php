<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\reportForm\models\MonthlyReport */

$this->title = 'Редактирование ежемесячного : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ежемесячный отчёт', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="monthly-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
