<?php

namespace frontend\modules\report\services;

use common\modules\reportForm\models\MonthlyReport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;

/**
 * Сервис загрузки отчётов из файла
 */
class ImportFileService
{
    /** @var int Номер колонки в excel файле, в которой записан ID предприятия */
    public const COLUMN_NUMBER_COMPANY_ID = 1;

    /** @var int Номер колонки в excel файле, в которой записано количество работников */
    public const COLUMN_NUMBER_WORKERS = 2;

    /** @var int Номер колонки в excel файле, в которой записана средняя зарплата */
    public const COLUMN_NUMBER_SALARY = 3;

    /** @var int Номер колонки в excel файле, в которой записана сумма уплаченных налогов */
    public const COLUMN_NUMBER_TAXES = 4;

    /** @var int Номер колонки в excel файле, в которой записана сумма начислений по энергоснабжению */
    public const COLUMN_NUMBER_ENERGY_AMOUNT = 5;

    /** @var int Номер колонки в excel файле, в которой записано наименование поставщика энергоснабжения */
    public const COLUMN_NUMBER_ENERGY_ORGANIZATION = 6;

    /**
     * @var \yii\web\UploadedFile
     */
    private UploadedFile $file;

    /** @var int Всего успешно загружено */
    private int $successCount = 0;

    /** @var int Всего ошибок загрузки */
    private int $failCount = 0;

    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    // Создание отчётов из файла
    public function import()
    {
        $spreadsheet = IOFactory::load($this->file->tempName);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        for ($row = 2; $row <= $highestRow; ++$row) {
            $model = new MonthlyReport();
            $model->company_id = (int) $worksheet->getCellByColumnAndRow(self::COLUMN_NUMBER_COMPANY_ID, $row)->getValue();
            $model->workers = (int) $worksheet->getCellByColumnAndRow(self::COLUMN_NUMBER_WORKERS, $row)->getValue();
            $model->salary = (float) $worksheet->getCellByColumnAndRow(self::COLUMN_NUMBER_SALARY, $row)->getValue();
            $model->taxes = (float) $worksheet->getCellByColumnAndRow(self::COLUMN_NUMBER_TAXES, $row)->getValue();
            $model->energy_amount = (float) $worksheet->getCellByColumnAndRow(
                self::COLUMN_NUMBER_ENERGY_AMOUNT,
                $row
            )->getValue();
            $model->energy_organization = (string) $worksheet->getCellByColumnAndRow(
                self::COLUMN_NUMBER_ENERGY_ORGANIZATION,
                $row
            )->getValue();

            if ($model->save()) {
                $this->successCount++;
            } else {
                $this->failCount++;
            }
        }
    }

    /**
     * Количество успешно загруженных отчётов
     * @return int
     */
    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    /**
     * Количество отчётов, которые не получилось загрузить
     *
     * @return int
     */
    public function getFailCount(): int
    {
        return $this->failCount;
    }
}
