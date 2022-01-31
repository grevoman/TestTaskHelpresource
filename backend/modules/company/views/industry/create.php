<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\company\models\Industry */

$this->title = 'Добавить новую отрасль';
$this->params['breadcrumbs'][] = ['label' => 'Отрасли', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="industry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
