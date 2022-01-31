<?php

namespace frontend\modules\report\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportFileForm extends Model
{
    /**
     * @var UploadedFile|string
     */
    public $reportFile;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            ['reportFile', 'required'],
            [['reportFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xls, csv, ods'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'reportFile' => 'Импорт отчёта из файла',
        ];
    }
}