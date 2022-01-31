<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\company\models\IndustryType */

$this->title = 'Добавить новый тип отрасли';
$this->params['breadcrumbs'][] = ['label' => 'Industry Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="industry-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
