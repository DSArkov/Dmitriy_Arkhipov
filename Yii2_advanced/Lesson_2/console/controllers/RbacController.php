<?php

//Регистрируем класс в пространстве имён.
namespace console\controllers;

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
        $guest = $authManager->createRole('guest');

        $authManager->add($admin);
        $authManager->add($user);
        $authManager->add($guest);

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
    }
}