<?php

namespace backend\modules\reportForm\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * ManagerReportAsset asset bundle.
 */
class ManagerReportAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@backend/modules/reportForm/assets/dist/';

    /**
     * @var string[]
     */
    public $js = [
        'js/managerReport.js',
    ];

    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    /**
     * @var string[]
     */
    public $depends = [
        JqueryAsset::class,
    ];
}
