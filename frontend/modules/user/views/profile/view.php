<?php
/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3><?= Html::encode($user->username); ?></h3>
            <p><?= HtmlPurifier::process($user->about); ?></p>
            <hr>
        </div>
    </div>
    <div class="row" style="margin: 10px -15px;">
        <div class="col-xs-12">
            <h4>Frinds, who are also following <?= Html::encode($user->username); ?></h4>

                <?php foreach ($currentUser->getMutualsSubscriptionsTo($user) as $item) : ?>
                <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]); ?>">
                <?= Html::encode($item['username']); ?>
                </a>
<?php endforeach; ?>
        </div>
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
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Subscribe</a>
            <a href="<?php echo Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Unsubscribe</a>
        </div>
    </div>
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