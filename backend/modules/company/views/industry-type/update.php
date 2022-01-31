<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\company\models\IndustryType */

$this->title = 'Редактирование типов отраслей: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы отраслей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="industry-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
