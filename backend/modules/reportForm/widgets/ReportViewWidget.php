<?php

namespace backend\modules\reportForm\widgets;

use yii\bootstrap4\Widget;

/**
 * Виджет для вывода сводного отчёта
 */
class ReportViewWidget extends Widget
{
    /** @var array Данные для вывода */
    public array $data = [];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if (!$this->data) {
            return '';
        }

        return $this->render('index', ['reportsData' => $this->data]);
    }
}