<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200114_230235_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(20)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'group' => $this->string()->defaultValue('brand'),
        ]);

        $this->batchInsert('{{%user}}',
            ['username', 'auth_key', 'password', 'email', 'group'],
            [
                ["admin", Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('admin123'), "admin@example.com", "admin"],
                ["guest", Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('guest123'), "guest@example.com", "brand"]
            ]
        );

        // access to users
        $auth = \Yii::$app->authManager;
        $roleBrand = $auth->getRole('brand');
        $roleAdmin = $auth->getRole('admin');

        $auth->assign($roleAdmin, 1);
        $auth->assign($roleBrand, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
