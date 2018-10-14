<?php

namespace tests\models;

use app\models\Company;
use app\models\User;
use app\models\RegisterForm;
use tests\unit\fixtures\UserFixture;

class RegisterFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;


    public function testCorrectSignupIndiviual()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost.dev',
            'fullname' => 'Unit Test',
            'userType' => User::TYPE_I
        ]);
        $user = $model->signup();
        expect($user)->isInstanceOf(User::class);
        expect($user->username)->equals('unit@localhost.dev');
        expect($user->email)->equals('unit@localhost.dev');
        expect($user->validatePassword('unit@localhost.dev'))->true();
    }

    public function testIncorrectSignupIndiviual()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost',
            'userType' => User::TYPE_I
        ]);
        expect_not($model->signup());
        expect_that($model->getErrors('fullname'));
        expect_that($model->getErrors('email'));
    }

    public function testIncorrectSignupIndiviualEmployerWithEmptyInn()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost.dev',
            'fullname' => 'Unit Test',
            'userType' => User::TYPE_IE
        ]);
        expect_not($model->signup());
        expect_that($model->getErrors('inn'));
    }

    public function testIncorrectSignupIndiviualEmployerWithIncorrectInn()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost.dev',
            'fullname' => 'Unit Test',
            'userType' => User::TYPE_IE,
            'inn' => '123456'
        ]);
        expect_not($model->signup());
        expect_that($model->getErrors('inn'));
    }

    public function testCorrectSignupIndiviualEmployer()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost.dev',
            'fullname' => 'Unit Test',
            'userType' => User::TYPE_IE,
            'inn' => '123456123123'
        ]);
        $user = $model->signup();
        expect($user)->isInstanceOf(User::class);
        expect($user->username)->equals('unit@localhost.dev');
        expect($user->email)->equals('unit@localhost.dev');
        expect($user->inn)->equals('123456123123');
        expect($user->type)->equals(User::TYPE_IE);
        expect($user->validatePassword('unit@localhost.dev'))->true();
    }

    public function testIncorrectSignupIndiviualLegalpersonWithEmptyCompanyname()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost.dev',
            'fullname' => 'Unit Test',
            'userType' => User::TYPE_LP,
            'inn' => '123456123123'
        ]);
        expect_not($model->signup());
        expect_that($model->getErrors('companyName'));
    }

    public function testCorrectSignupLegalperson()
    {
        $model = new RegisterForm([
            'email' => 'unit@localhost.dev',
            'fullname' => 'Unit Test',
            'userType' => User::TYPE_IE,
            'inn' => '123456123123',
            'companyName' => 'Test Company'
        ]);
        $user = $model->signup();
        expect($user)->isInstanceOf(User::class);
        expect($user->username)->equals('unit@localhost.dev');
        expect($user->email)->equals('unit@localhost.dev');
        expect($user->inn)->equals('123456123123');
        expect($user->type)->equals(User::TYPE_IE);
        expect($user->validatePassword('unit@localhost.dev'))->true();
    }

}