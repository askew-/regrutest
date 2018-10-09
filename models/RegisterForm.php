<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{

    public $fullname;
    public $email;
    public $company_name;
    public $inn;
    public $userType;

    public function rules(): array
    {
        return [
            [['fullname', 'email', 'userType'], 'required'],
            ['inn', 'integer'],
            ['inn', 'string', 'length' => 9],
            [
                'inn',
                'required',
                'when' => function ($model) {
                    return \in_array($model->userType, [User::TYPE_LP, User::TYPE_IE], true);
                },
                'enableClientValidation' => false
            ],
            [
                'company_name',
                'required',
                'when' => function ($model) {
                    return $model->userType === User::TYPE_LP;
                },
                'enableClientValidation' => false
            ],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email is already taken']
        ];
    }

    public function signup(): User
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User;
        $user->fullname = $this->fullname;
        $user->email = $this->email;
        $user->type = $this->userType;
        $user->username = $this->email;
        if ($this->userType !== User::TYPE_I) {
            $user->inn = $this->inn;
        }
        $user->password = \Yii::$app->security->generatePasswordHash($this->email);
        if ($user->save()) {
            if ($user->type === User::TYPE_LP) {
                $company = new Company();
                $company->title = $this->company_name;
                $company->user_id = $user->id;
                $company->save();
            }
        }

        return $user;
    }
}
