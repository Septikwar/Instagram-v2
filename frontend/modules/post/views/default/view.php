<?php
/* @var $this yii\web\View */
/* @var $post frontend\models\Post */
/* @var $comments frontend\models\Comments */

use yii\widgets\ActiveForm;
use yii\web\JqueryAsset;
use yii\helpers\Html;
?>

<div class="post-view-container">
    <h1>Author: <?php if ($post->user) {
    echo $post->user->username;
} ?></h1>

    <div class="row">
        <div class="col-md-12 image-main">
            <img src="<?php echo $post->getImage(); ?>" alt="">
        </div>
        <div class="col-md-12">
<?php echo Html::encode($post->description); ?>
        </div>
    </div>
    <div class="row likes-container">
        <div class="col-md-12">
            <span class="likes">Likes: <span><?php echo $post->countLikes(); ?></span></span>
            <a href="#" class="btn btn-primary button-like <?php echo ($user && $post->isLikedBy($user)) ? "display-none" : ""; ?>" data-id="<?php echo $post->id; ?>">
                Like <span class="glyphicon glyphicon-thumbs-up"></span>
            </a>
            <a href="#" class="btn btn-primary button-dislike <?php echo ($user && $post->isLikedBy($user)) ? "" : "display-none"; ?>" data-id="<?php echo $post->id; ?>">
                Dislike <span class="glyphicon glyphicon-thumbs-down"></span>
            </a>
        </div>

    </div>
</div>

<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
]);
