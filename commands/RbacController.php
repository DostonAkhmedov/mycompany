<?php


namespace app\commands;


use app\rbac\UserGroupRule;
use app\rbac\UserProfileOwnerRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        /**
         * Create roles
        */
        // Not an authorized user;
        $guest  = $auth->createRole('guest');
        // An authorized user inherits the permissions of the guest role and has its own unique permissions;
        $brand  = $auth->createRole('brand');
        // An authorized user inherits the permissions of the guest, brand roles and has its own unique permissions.
        $admin  = $auth->createRole('admin');

        // Create simple, based on action{$NAME} permissions
        $login  = $auth->createPermission('login');
        $logout = $auth->createPermission('logout');
        $error  = $auth->createPermission('error');
        $signUp = $auth->createPermission('sign-up');
        $index  = $auth->createPermission('index');
        $view   = $auth->createPermission('view');
        $update = $auth->createPermission('update');
        $delete = $auth->createPermission('delete');

        // Add permissions in Yii::$app->authManager
        $auth->add($login);
        $auth->add($logout);
        $auth->add($error);
        $auth->add($signUp);
        $auth->add($index);
        $auth->add($view);
        $auth->add($update);
        $auth->add($delete);


        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $auth->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName  = $userGroupRule->name;
        $brand->ruleName  = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $auth->add($guest);
        $auth->add($brand);
        $auth->add($admin);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $auth->addChild($guest, $login);
        $auth->addChild($guest, $logout);
        $auth->addChild($guest, $error);
        $auth->addChild($guest, $signUp);
        $auth->addChild($guest, $index);
        $auth->addChild($guest, $view);

        // BRAND
        $auth->addChild($brand, $guest);

        // Admin
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);
        $auth->addChild($admin, $brand);

        // add the rule
        $userProfileOwnerRule = new UserProfileOwnerRule();
        $auth->add($userProfileOwnerRule);

        $updateOwnProfile = $auth->createPermission('updateOwnProfile');
        $updateOwnProfile->ruleName = $userProfileOwnerRule->name;
        $auth->add($updateOwnProfile);

        $auth->addChild($brand, $updateOwnProfile);
    }
}