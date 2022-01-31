<?php

namespace backend\modules\reportForm\controllers;

use backend\modules\reportForm\services\ReportBuilder;
use common\modules\company\models\Industry;
use common\modules\reportForm\models\search\MonthlyReportSearch;
use yii\caching\TagDependency;
use yii\web\Controller;
use yii\web\Response;

/**
 * Отчёты для менеджеров
 */
class ManagerReportController extends Controller
{
    /**
     * Lists all MonthlyReport models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'searchModel' => new MonthlyReportSearch(),
            'reportsData' => ReportBuilder::getReportData($this->request->queryParams),
        ]);
    }

    /**
     * Список предприятий по отрасли
     *
     * @param string $type
     *
     * @return \yii\web\Response
     */
    public function actionGetIndustries(string $type): Response
    {
        $list = Industry::find()
            ->select(['name', 'id'])
            ->where(['type_id' => (int)$type])
            ->indexBy('id')
            ->cache(true, new TagDependency(['tags' => [Industry::class]]))
            ->column();

        return $this->asJson(['success' => true, 'data' => $list]);
    }

    /**
     * Экспорт отчёта в файл
     *
     * @return void
     */
    public function actionExport()
    {
        ReportBuilder::getReportFile($this->request->queryParams);
    }
}
