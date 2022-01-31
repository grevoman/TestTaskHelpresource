<?php

namespace frontend\modules\report\controllers;

use common\modules\reportForm\models\MonthlyReport;
use frontend\modules\report\forms\ImportFileForm;
use frontend\modules\report\services\ImportFileService;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * MonthlyReportController implements the CRUD actions for MonthlyReport model.
 */
class MonthlyReportController extends Controller
{
    /**
     * @var string
     */
    public $defaultAction = 'create';

    /**
     * Creates a new MonthlyReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MonthlyReport();
        $importFileForm = new ImportFileForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->render('result');
            }

            if ($importFileForm->load($this->request->post())) {
                $importFileForm->reportFile = UploadedFile::getInstance($importFileForm, 'reportFile');
                if ($importFileForm->validate()) {
                    $importService = new ImportFileService($importFileForm->reportFile);
                    $importService->import();

                    return $this->render(
                        'result',
                        [
                            'successCount' => $importService->getSuccessCount(),
                            'failCount' => $importService->getFailCount(),
                        ]
                    );
                }
            } else {
                $model->loadDefaultValues();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'importFileForm' => $importFileForm,
        ]);
    }
}
