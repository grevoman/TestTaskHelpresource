<?php

namespace backend\modules\reportForm\services;

use common\modules\company\models\Company;
use common\modules\company\models\Industry;
use common\modules\company\models\IndustryType;
use common\modules\reportForm\models\MonthlyReport;
use common\modules\reportForm\models\search\MonthlyReportSearch;
use Yii;
use yii\db\Expression;
use yii\web\Response;

/**
 * Сервис формирования сводного отчёта на основании отчётов, полученных от предприятий
 */
class ReportBuilder
{
    /**
     * Получение данных для вывода сводного отчёта
     *
     * @param array $params
     *
     * @return array
     */
    public static function getReportData(array $params): array
    {
        if (!$params) {
            return [];
        }

        $searchModel = new MonthlyReportSearch();
        $query = $searchModel->searchQuery($params);

        $reportIds = $query->select(MonthlyReport::tableName() . '.[[id]]')->column();
        $reportsData = MonthlyReport::find()->joinWith('companyRelation.industryRelation.industryTypeRelation', false)
            ->select([
                'industry' => Industry::tableName() . '.[[name]]',
                'industryType' => IndustryType::tableName() . '.[[name]]',
                'workers' => new Expression(sprintf('sum(%s)', MonthlyReport::tableName() . '.[[workers]]')),
                'salary' => new Expression(sprintf('avg(%s)', MonthlyReport::tableName() . '.[[salary]]')),
                'taxes' => new Expression(sprintf('sum(%s)', MonthlyReport::tableName() . '.[[taxes]]')),
                'energy_amount' => new Expression(
                    sprintf('sum(%s)', MonthlyReport::tableName() . '.[[energy_amount]]')
                ),
            ])
            ->where([MonthlyReport::tableName() . '.[[id]]' => $reportIds])
            ->groupBy(Company::tableName() . '.[[industry_id]]')
            ->asArray()
            ->all();

        $result = [];

        foreach ($reportsData as $item) {
            $result[$item['industryType']][] = $item;
        }

        return $result;
    }


    /**
     * Экспорт сводного отчёта в файл
     *
     * @param $params
     *
     * @return void
     */
    public static function getReportFile($params)
    {
        $searchModel = new MonthlyReportSearch();
        $query = $searchModel->searchQuery($params);
        $headers = [
            1 => $searchModel->getAttributeLabel('id'),
            $searchModel->getAttributeLabel('companyRelation.industryRelation.type_id'),
            $searchModel->getAttributeLabel('companyRelation.industry_id'),
            $searchModel->getAttributeLabel('workers'),
            $searchModel->getAttributeLabel('salary'),
            $searchModel->getAttributeLabel('taxes'),
            $searchModel->getAttributeLabel('energy_amount'),
        ];

        $filename = sys_get_temp_dir() . '/' . uniqid('report_');
        $tempFile = fopen($filename, 'wb');

        //add BOM to fix UTF-8 in Excel
        fwrite($tempFile, pack('CCC', 0xef, 0xbb, 0xbf));

        fputcsv($tempFile, $headers, ';');

        foreach ($query->batch() as $batch) {
            /** @var MonthlyReport $model */
            foreach ($batch as $model) {
                fputcsv(
                    $tempFile,
                    [
                        $model->id,
                        $model->companyRelation->industryRelation->industryTypeRelation->name ?? '',
                        $model->companyRelation->industryRelation->name ?? '',
                        $model->workers,
                        $model->salary,
                        $model->taxes,
                        $model->energy_amount,
                    ],
                    ';'
                );
            }
        }
        fclose($tempFile);

        return Yii::$app->response
            ->sendFile($filename, 'Сводный отчёт на' . date('Y-m-d') . '.csv')
            ->on(
                Response::EVENT_AFTER_SEND,
                function () use ($filename) {
                    unlink($filename);
                }
            );
    }
}