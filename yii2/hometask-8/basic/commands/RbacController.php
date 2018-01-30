<?php

namespace app\commands;

use Yii;
use yii\console\Controller;


/**
 * Инициализатор RBAC выполняется в консоли
 * php yii rbac/init
 */

class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // На всякий случай удаляем старые данные из БД...
        $auth->removeAll();

        // Создадим роли админа, менеджера, пользователя
        $admin = $auth->createRole('admin');
        $manager = $auth->createRole('manager');
        $user = $auth->createRole('user');

        // Запишем их в БД
        $auth->add($admin);
        $auth->add($manager);
        $auth->add($user);

        // Создаем разрешения. Например, просмотр админки viewAdminPage
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $regUsers = $auth->createPermission('regUsers');
        $regUsers->description = 'Регистрация новых пользователей';

        $createProduct = $auth->createPermission('createProduct');
        $createProduct->description = 'Создание товара';

        $deleteProduct = $auth->createPermission('deleteProduct');
        $deleteProduct->description = 'Удаление товара';

        $updateProduct = $auth->createPermission('updateProduct');
        $updateProduct->description = 'Обновление товара';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($regUsers);
        $auth->add($createProduct);
        $auth->add($deleteProduct);
        $auth->add($updateProduct);

        // Разрешения
        $auth->addChild($admin, $viewAdminPage);
        $auth->addChild($admin, $regUsers);
        $auth->addChild($admin, $deleteProduct);

        $auth->addChild($manager, $createProduct);
        $auth->addChild($manager, $updateProduct);

        // Админ наследует роль менеджера и т.д.
        $auth->addChild($admin, $manager);
        $auth->addChild($manager, $user);

        // Назначаем роль admin пользователю с ID 1 и т.д.
        $auth->assign($admin, 1);
        $auth->assign($user, 2);
        $auth->assign($manager, 3);

    }
}