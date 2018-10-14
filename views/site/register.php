<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('registerFormSubmitted')) { ?>
        <div class="alert alert-success">
            Cпасибо за регистрация на нашем сайте
        </div>
    <?php } else { ?>
        <p>
            Форма регистрации
        </p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
                <?= $form->field($model, 'userType')->radioList(\app\models\User::getTypes()) ?>
                <?= $form->field($model, 'fullname') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'inn') ?>
                <?= $form->field($model, 'companyName') ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php } ?>
</div>
