<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Для входа под тестовым пользователем используйте testuser1@mail.ru:123456</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['/user/default/request-password-reset']) ?>.
                <br>
                Need new verification email? <?= Html::a('Resend', ['/user/default/resend-verification-email']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-7">
            <h2>Авторизация через Google</h2>
            <?=
            yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/user/default/auth'],
                'popupMode' => false,
            ])
            ?>
        </div>
    </div>
</div>
