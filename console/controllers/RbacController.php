<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение для доступа к админке
        $accessAdminArea = $auth->createPermission('accessAdminArea');
        $accessAdminArea->description = 'Access Admin Area';
        $auth->add($accessAdminArea);

        // добавляем разрешение для создания отчёта представителем предприятия
        $createReport = $auth->createPermission('createReport');
        $createReport->description = 'Create a report';
        $auth->add($createReport);

        // добавляем разрешение для создания и обновления справочников
        $updateData = $auth->createPermission('updateData');
        $updateData->description = 'Update/create data';
        $auth->add($updateData);
        $auth->addChild($updateData, $accessAdminArea);

        // добавляем разрешение для получения сводных отчётов за период
        $getReport = $auth->createPermission('getReport');
        $getReport->description = 'Update/create data';
        $auth->add($getReport);
        $auth->addChild($getReport, $accessAdminArea);

        // добавляем роль "customer" для представителя предприятия и даём роли разрешение "createReport"
        $customer = $auth->createRole('customer');
        $auth->add($customer);
        $auth->addChild($customer, $createReport);

        // добавляем роль "manager" и даём роли разрешения "updateData" и "getReport"
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $updateData);
        $auth->addChild($manager, $getReport);

        if ($userModel = User::findOne(['username' => 'user'])) {
            $auth->assign($customer, $userModel->getId());
        }

        if ($managerModel = User::findOne(['username' => 'manager'])) {
            $auth->assign($manager, $managerModel->getId());
        }
    }
}