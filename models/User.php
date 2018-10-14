<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @property $id
 * @property $email
 * @property $fullname
 * @property $type
 * @property $username
 * @property $inn
 * @property $password
 * @package app\models
 */
class User extends ActiveRecord implements IdentityInterface
{
    /** Individual Employer */
    const TYPE_IE = 'IE';

    /** Legal person*/
    const TYPE_LP = 'LP';

    /** Individual*/
    const TYPE_I = 'I';

    public static function tableName(): string
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

    public static function getTypes(): array
    {
        return [
            self::TYPE_LP => \Yii::t('app', 'Legal Person'),
            self::TYPE_IE => \Yii::t('app', 'Individual Employer'),
            self::TYPE_I => \Yii::t('app', 'Individual'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): ?User
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
        return static::findOne(['username' => $username]);
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
    public function validatePassword($password): bool
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
