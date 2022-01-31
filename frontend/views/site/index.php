<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">
<?php if (Yii::$app->user->isGuest): ?>
    <div class="jumbotron text-center bg-transparent">
        <p class="lead">
            Пользователь для отправки отчётности: user/user <?= Html::a(
                'User login',
                ['login'],
                ['class' => 'btn btn-primary']
            ) ?>
        </p>
        <p class="lead">
            Пользователь для администрирования и формирования отчётов: manager/manager <?= Html::a(
                'Admin login',
                ['/admin'],
                ['class' => 'btn btn-info']
            ) ?>
        </p>
    </div>
<?php elseif (Yii::$app->user->can('createReport')): ?>
    <?= Html::a(
        'Добавить отчёт',
        ['/report/monthly-report/create'],
        ['class' => 'btn btn-info']
    ) ?>
<?php endif; ?>
</div>
