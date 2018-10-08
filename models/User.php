<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /** Individual Employer */
    const TYPE_IE = 'IE';
    /** Legal person*/
    const TYPE_LP = 'LP';
    /** Individual*/
    const TYPE_I = 'I';

    public $username;

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Find by token not supported');
    }

    public static function getTypes()
    {
        return [
            self::TYPE_LP => 'Юридическое лицо',
            self::TYPE_IE => 'Индивидуальный предприниматель',
            self::TYPE_I => 'Физ лицо',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['fullname' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        throw new NotSupportedException('"getAuthKey" is not implemented.');
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('"validateAuthKey" is not implemented.');
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
