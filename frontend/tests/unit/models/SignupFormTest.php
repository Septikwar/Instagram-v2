<?php

namespace frontend\tests\models;

use frontend\tests\fixtures\UserFixture;
use frontend\modules\user\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className()
            ]
        ]);
    }
    
    public function testTrimUsername()
    {
        $model = new SignupForm([
            'username' => ' name user ',
            'email' => 'septikwar@gmail.com',
            'password' => '12345'
        ]);
        
        $model->signup();
        
        expect($model->username)->equals('name user');
    }
    
    public function testRequiredUsername()
    {
        $model = new SignupForm([
            'username' => '',
            'email' => 'septikwar@gmail.com',
            'password' => '12345'
        ]);
        
        $model->signup();
        
        expect($model->getFirstError('username'))->equals('Username cannot be blank.');
    }
    
    public function testEmailUnique()
    {
        $model = new SignupForm([
            'username' => 'some username',
            'email' => '1@got.com',
            'password' => 'some_password'
        ]);
        
        $model->signup();
        
        expect($model->getFirstError('email'))->equals('This email address has already been taken.');
    }
}
