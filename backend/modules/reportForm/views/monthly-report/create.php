<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\reportForm\models\MonthlyReport */

$this->title = 'Добавить отчёт';
$this->params['breadcrumbs'][] = ['label' => 'Ежемесячный отчёт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
