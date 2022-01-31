<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $successCount int */
/* @var $failCount int */

$this->title = 'Результат добавления отчёта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monthly-report-create">

    <h2>Отчёт добавлен успешно</h2>

    <p>
        <?php if(isset($successCount)): ?>
            Успешно загружено <?= $successCount ?> записей
        <?php endif; ?>
    </p>

    <p>
        <?php if(isset($failCount)): ?>
            Не удалось загрузить <?= $failCount ?> записей
        <?php endif; ?>
    </p>

    <?= Html::a(
        'Добавить отчёт',
        ['/report/monthly-report/create'],
        ['class' => 'btn btn-info']
    ) ?>
</div>
