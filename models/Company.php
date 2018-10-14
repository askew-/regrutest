<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Company
 * @property $id
 * @property $user_id
 * @property $title
 * @package app\models
 */
class Company extends ActiveRecord
{

    public static function tableName(): string
    {
        return '{{%company}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
