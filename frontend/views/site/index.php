<?php
/* @var $feed[] frontend\models\Feed */
/* @var $currentUser frontend\models\User */
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

use yii\web\JqueryAsset;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<div class="site-index">
    <?php if ($feed) : ?>
        <?php foreach ($feed as $item) : ?>
            <?php /* @var $item Feed */ ?>
            <div class="row">
                <div class="col-md-12">
                    <img src="<?php echo $item->author_picture; ?>" width="30" height="30" alt="">
                    <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($item->author_nickname) ? $item->author_nickname : $item->author_id]); ?>">
                        <?php echo Html::encode($item->author_name); ?>
                    </a>
                </div>

                <div class="col-md-12">
                    <img src="<?php echo Yii::$app->storage->getFile($item->post_filename); ?>" alt="">
                </div>
                <div class="col-md-12">
                    <?php echo HtmlPurifier::process($item->post_description); ?>
                </div>
                <div class="col-md-12">
                    <?php echo Yii::$app->formatter->asDatetime($item->post_created_at); ?>
                </div>
                
                <div class="col-md-12 likes-container">
                    <span class="likes">Likes: <span><?php echo $item->countLikes(); ?></span></span>
                    <a href="#" class="btn btn-primary button-like <?php echo ($currentUser->likesPost($item->post_id)) ? "display-none" : ""; ?>" data-id="<?php echo $item->post_id; ?>">
                        Like <span class="glyphicon glyphicon-thumbs-up"></span>
                    </a>
                    <a href="#" class="btn btn-primary button-dislike <?php echo ($currentUser->likesPost($item->post_id)) ? "" : "display-none"; ?>" data-id="<?php echo $item->post_id; ?>">
                        Dislike <span class="glyphicon glyphicon-thumbs-down"></span>
                    </a>
                </div>
                <hr>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-md-12">Nobody posted yet</div>               
    <?php endif; ?>
</div>

<?php $this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
    ]);