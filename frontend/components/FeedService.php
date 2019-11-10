<?php
namespace frontend\components;

use frontend\models\Feed;
use yii\base\Component;

class FeedService extends Component
{
    /**
     * @param \yii\base\Event $event
     */
    public function addToFeeds(\yii\base\Event $event)
    {
        $user = $event->getUser();
        $post = $event->getPost();
        
        $followers = $user->getFollowers();
        
        foreach ($followers as $feedItem) {
            $follower = new Feed();
            $follower->user_id = $feedItem['id'];
            $follower->author_id = $user->id;
            $follower->author_name = $user->username;
            $follower->author_nickname = $user->getNickname();
            $follower->author_picture = $user->getPicture();
            $follower->post_id = $post->id;
            $follower->post_filename = $post->filename;
            $follower->post_description = $post->description;
            $follower->post_created_at = $post->created_at;
            $follower->save();
        }
    }
    
}
