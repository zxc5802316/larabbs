<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function show(Category $category,Request $request,Topic $topic,User $user,Link $link,Tag $tag){
//      dump($request->order);
      $topics = $topic->where('category_id',$category->id)->withOrder($request->order)->paginate(20);
      // 活跃用户列表
      $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
      // 传参变量话题和分类到模板中
      $tags = $tag->all();
      return view('topics.index', compact('topics', 'category', 'active_users','links','tags'));
  }
}
