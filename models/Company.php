<?php

namespace app\models;

use yii\db\ActiveRecord;

class Company extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%company}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'id']);
    }
}