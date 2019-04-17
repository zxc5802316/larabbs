<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
      $reply->topic->updateReplyCount();
        $reply->topic->user->toNotify(new TopicReplied($reply));
    }

    public function creating(Reply $reply)
    {
        $reply->content = str_replace("{","<span>{</span>",$reply->content);
        $reply->content = str_replace("}","<span>}</span>",$reply->content);
        $reply->content = clean($reply->content,"user_topic_body");
    }

    public function deleted(Reply $reply){
        $reply->topic->updateReplyCount();
    }
}