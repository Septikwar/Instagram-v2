<?php

namespace frontend\modules\post\controllers;

use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\models\Post;
use frontend\modules\post\models\forms\PostForm;
use Yii;
use yii\web\Response;
/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        $model = new PostForm(Yii::$app->user->identity);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Post created');
                return $this->goHome();
            }
        }
        return $this->render('create', [
            'model' => $model
            ]);
    }
    
    
    /*
     * Renders the create view for the module
     * @return string
     */
    public function actionView($id)
    {
        $user = Yii::$app->user->identity;
        return $this->render('view', [
           'post' => $this->findPost($id),
           'user' => $user,
        ]);
    }
    
    
    /**
     * @param integer $id
     * @return User
     * @throws NotFoundHttpException
     */
            
    private function findPost($id)
    {
        if ($post = Post::findOne($id)) {
            return $post;
        }
        throw new NotFoundHttpException();
    }
    
    public function actionLike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/user/default/login');
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        
        $id = Yii::$app->request->post('data-id');
        $post = $this->findPost($id);
        
        $post->like($currentUser);
        return [
            'success' => true,
            'likes' => $post->countLikes() 
        ];
    }
    
    public function actionDislike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/user/default/login');
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        
        $id = Yii::$app->request->post('data-id');
        $post = $this->findPost($id);
        
        $post->dislike($currentUser);
        
        return [
            'success' => true,
            'likes' => $post->countLikes()
        ];
    }

    public function actionComplain()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $id = Yii::$app->request->post('id');
        
        /* @var $currentUser */
        $currentUser = Yii::$app->user->identity;
        
        $post = $this->findPost($id);
        
        if ($post->complain($currentUser)) {
            return [
                'success' => true,
                'text' => 'Post reported'
            ];
        }
    }
}
