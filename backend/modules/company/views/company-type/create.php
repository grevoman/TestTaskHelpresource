<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\company\models\CompanyType */

$this->title = 'Добавить новый тип';
$this->params['breadcrumbs'][] = ['label' => 'Типы предприятий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
