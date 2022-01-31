<?php

use common\modules\reportForm\models\search\MonthlyReportSearch;

/* @var $this yii\web\View */
/* @var $reportsData array */

$searchModel = new MonthlyReportSearch();
?>
<?php foreach ($reportsData as $type => $data): ?>
    <h2><span class="bd-content-title">Тип отрасли: <?= $type ?></span></h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?= $searchModel->getAttributeLabel('companyRelation.industry_id') ?></th>
            <th scope="col"><?= $searchModel->getAttributeLabel('workers') ?></th>
            <th scope="col"><?= $searchModel->getAttributeLabel('salary') ?></th>
            <th scope="col"><?= $searchModel->getAttributeLabel('taxes') ?></th>
            <th scope="col"><?= $searchModel->getAttributeLabel('energy_amount') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $index => $item): ?>
            <tr>
                <th scope="row"><?= ++$index ?></th>
                <td><?= $item['industry'] ?></td>
                <td><?= $item['workers'] ?></td>
                <td><?= $item['salary'] ?></td>
                <td><?= $item['taxes'] ?></td>
                <td><?= $item['energy_amount'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>