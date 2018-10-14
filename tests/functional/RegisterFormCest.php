<?php

class RegisterFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/register']);
    }

    public function openContactPage(\FunctionalTester $I)
    {
        $I->see('Регистрация', 'h1');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#register-form', []);
        $I->expectTo('see validations errors');
        $I->see('Email cannot be blank.');
        $I->see('User Type cannot be blank.');
        $I->see('Fullname cannot be blank.');
    }

    public function submitFormIndividualUserTypeWithInvalidEmail(\FunctionalTester $I)
    {
        $I->submitForm('#register-form', [
            'RegisterForm[userType]' => \app\models\User::TYPE_I,
            'RegisterForm[fullname]' => 'test test test',
            'RegisterForm[email]' => 'test@test',
        ]);
        $I->expectTo('see that email address is wrong');
        $I->dontSee('Fullname cannot be blank.', '.help-inline');
        $I->see('Email is not a valid email address.');
    }

    public function submitFormIndividualUserTypeSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#register-form', [
            'RegisterForm[userType]' => \app\models\User::TYPE_I,
            'RegisterForm[fullname]' => 'test test test',
            'RegisterForm[email]' => 'test@test.com',
        ]);
        $I->dontSeeElement('#register-form');
        $I->see('Cпасибо за регистрация на нашем сайте');
    }
}
