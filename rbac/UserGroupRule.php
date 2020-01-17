<?php
namespace app\rbac;

use app\models\User;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{

    public $name = 'userGroup';

    /**
     * @inheritDoc
     */
    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $group = \Yii::$app->user->identity->group;
            if ($item->name === User::ROLE_ADMIN) {
                return $group == User::ROLE_ADMIN;
            } elseif ($item->name === User::ROLE_BRAND) {
                return $group == User::ROLE_ADMIN || $group == User::ROLE_BRAND;
            }
        }
        return true;
    }
}
