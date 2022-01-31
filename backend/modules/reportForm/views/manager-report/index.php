<?php

use backend\modules\reportForm\widgets\ReportViewWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\reportForm\models\search\MonthlyReportSearch */
/* @var $reportsData array|null */

$this->title = 'Отчёт за период';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= ReportViewWidget::widget(['data' => $reportsData]) ?>
</div>
