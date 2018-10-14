<?php
namespace tests\unit\fixtures;

use yii\test\ActiveFixture;
use app\models\User;

class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}