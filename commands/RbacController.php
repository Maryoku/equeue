<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole('admin');
        $operator = $auth->createRole('operator');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($operator);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $viewOperator = $auth->createPermission('viewOperator');
        $viewOperator->description = 'Cтраница оператора';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($viewOperator);

        // Теперь добавим наследования. Для роли $operator мы добавим разрешение $viewOperator,
        // а для админа добавим наследование от роли $operator и еще добавим собственное разрешение $viewAdminPage

        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        $auth->addChild($operator,$viewOperator);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $operator);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($admin, 1);

        // Назначаем роль $operator пользователю с ID 2
        $auth->assign($operator, 2);

    }
}

