<?php

namespace frontend\modules\user\controllers;

use frontend\models\User;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionView($id)
    {
        return $this->render('view', ['user' => $this->findUser($id)]);
    }
    public function findUser($id)
    {
        if ($user = User::find()->where(['id' => $id])->one()) {
            return $user;
        }
    }
}
