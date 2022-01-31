<?php

use common\modules\reportForm\models\MonthlyReport;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\reportForm\models\search\MonthlyReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ежемесячный отчёт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить ежемесячный отчёт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'companyRelation.name',
            'workers',
            'salary',
            'taxes',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, MonthlyReport $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
