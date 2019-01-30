<?php

//Регистрируем класс в пространстве имён.
namespace app\commands;

//Используем клас.
use yii\console\Controller;


/**
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
    /**
     * Метод добавляет базовые роли и разрешения.
     * @throws \Exception
     */
    public function actionIndex()
    {
        $authManager = \Yii::$app->authManager;

        $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');
        $watcher = $authManager->createRole('watcher');

        $authManager->add($admin);
        $authManager->add($user);
        $authManager->add($watcher);

        $permissionAdministrate = $authManager->createPermission('Administrate');
        $permissionTaskAddComment = $authManager->createPermission('TaskAddComment');
        $permissionTaskAddFile = $authManager->createPermission('TaskAddFile');

        $authManager->add($permissionAdministrate);
        $authManager->add($permissionTaskAddComment);
        $authManager->add($permissionTaskAddFile);

        $authManager->addChild($admin, $permissionAdministrate);
        $authManager->addChild($admin, $permissionTaskAddComment);
        $authManager->addChild($admin, $permissionTaskAddFile);
        $authManager->addChild($user, $permissionTaskAddComment);
        $authManager->addChild($user, $permissionTaskAddFile);

        $authManager->assign($admin, 1);
        $authManager->assign($admin, 3);
        $authManager->assign($user, 2);
        $authManager->assign($user, 4);
        $authManager->assign($user, 5);
        $authManager->assign($watcher, 6);
    }
}