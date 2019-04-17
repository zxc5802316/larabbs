<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag ,Request $request,Link $link,User $user,Topic $topic){
        $topics = $topic->where('tag_id',$tag->id)->withOrder($request->order)->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        $tags = $tag->all();
        return view("tags.index",compact("tag",'tags','links','active_users','topics'));
    }
}
