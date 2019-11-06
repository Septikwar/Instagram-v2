<?php
/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */
/* @var $pictureForm frontend\modules\user\models\forms\PictureForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3><?= Html::encode($user->username); ?></h3>
            <p><?= HtmlPurifier::process($user->about); ?></p>
            <hr>
        </div>
    </div>
    
    <img src="<?= $user->getPicture(); ?>" alt="" id="profile-picture">
<?php if ($currentUser && $currentUser->equals($user)) : ?>
    <div class="alert alert-success display-none" id="profile-image-success">Profile image updated</div>
    <div class="alert alert-danger display-none" id="profile-image-fail"></div>
    
    <?=
    FileUpload::widget([
        'model' => $modelPicture,
        'attribute' => 'picture',
        'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
            if (data.result.success) {
                $("#profile-image-success").show();
                $("#profile-image-fail").hide();
                $("#profile-picture").attr("src", data.result.pictureUri);
            } else {
                $("#profile-image-fail").html(data.result.errors.picture).show();
                $("#profile-image-success").hide();
            }
            }',
        ],
    ]);
    ?>
    
    <a href="<?= Url::to(['/user/profile/delete-picture']); ?>" class="btn btn-danger">Delete Picture</a>
<?php endif; ?>
    <div class="row" style="margin: 10px -15px;">
<?php if (!Yii::$app->user->isGuest && $currentUser->getMutualsSubscriptionsTo($user)) : ?>
            <div class="col-xs-12">

                <h4>Friends, who are also following <?= Html::encode($user->username); ?></h4>

                <?php foreach ($currentUser->getMutualsSubscriptionsTo($user) as $item) : ?>
                    <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]); ?>">
                <?= Html::encode($item['username']); ?>
                    </a>
            <?php endforeach; ?>
            </div>
<?php endif; ?>
<?php if ($currentUser && !$currentUser->equals($user)) : ?>
            <div class="col-xs-12">
                <h2>Profile subscribers & followers:</h2>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#subscribers">
                    Subscriptions: <?= $user->countSubscribers(); ?>
                </button>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#followers">
                    Followers: <?= $user->countFollowers(); ?>
                </button>
                <hr>
            </div>
    <?php endif; ?>
    </div>

<?php if ($currentUser && !$currentUser->equals($user)) : ?>
        <div class="row">
            <div class="col-xs-12">
                <?php if (!$currentUser->checkStatusSubscribe($user)) : ?>
                    <a href="<?php echo Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Subscribe</a>
    <?php else : ?>
                    <a href="<?php echo Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Unsubscribe</a>
        <?php endif; ?>
            </div>
        </div>
<?php endif; ?>
</div>



<div class="modal fade" id="subscribers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Subscribers</h4>
            </div>
            <div class="modal-body">
<?php foreach ($user->getSubscriptions() as $subscribers) : ?>
                    <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($subscribers['nickname']) ? $subscribers['nickname'] : $subscribers['id']]); ?>"><?= Html::encode($subscribers['username']); ?></a><br>
<?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="followers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Subscribers</h4>
            </div>
            <div class="modal-body">
<?php foreach ($user->getFollowers() as $followers) : ?>
                    <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($followers['nickname']) ? $followers['nickname'] : $followers['id']]); ?>"><?= Html::encode($followers['username']); ?></a><br>
<?php endforeach; ?>
            </div>
        </div>
    </div>
</div>