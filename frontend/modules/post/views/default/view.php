<?php
/* @var $this yii\web\View */
/* @var $post frontend\models\Post */

use yii\helpers\Html;

?>

<div class="post-view-container">
    <h1>Author: <?php if ($post->user) { echo $post->user->username; } ?></h1>
    
    <div class="row">
        <div class="col-md-12">
            <img src="<?php echo $post->getImage(); ?>" alt="">
        </div>
        <div class="col-md-12">
            <?php echo Html::encode($post->description); ?>
        </div>
    </div>
    
</div>
