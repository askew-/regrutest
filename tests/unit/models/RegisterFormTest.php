<?php

namespace tests\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin@localhost.dev');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin@localhost.dev'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin@localhost.dev');
        expect_that($user->validatePassword('admin@localhost.dev'));
        expect_not($user->validatePassword('123456'));        
    }
}
