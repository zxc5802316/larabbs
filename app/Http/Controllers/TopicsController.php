<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use NoisyWinds\Smartmd\Markdown;


class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request,Topic $topic,User $user,Link $link,Tag $tag)
	{
		$topics = $topic->with(["user","category","tag"])->withOrder($request->order)->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        $tags = $tag->all();
        return view('topics.index', compact('topics', 'active_users', 'links',"tags"));
	}

    public function show(Request $request,Topic $topic,User $user)
    {
        if(! empty($topic->slug) && $topic->slug != $request->slug){
            return redirect($topic->link());
        }
        $usertopics  = $user->find($topic->user_id)->topics->sortByDesc("created_at")->take(6)->all();
        return view('topics.show', compact('topic',"usertopics"));
    }

	public function create(Topic $topic,Tag $tag)
	{
        $categories  = Category::all();
        $tags = $tag->all();
		return view('topics.create_and_edit', compact('topic',"categories",'tags'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
		$topic->fill($request->all());
		$topic->user_id = \Auth::id();
		$topic->save();
		return redirect()->to($topic->link())->with('success', '帖子创建成功！');
	}

	public function edit(Topic $topic,Tag $tag)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
        $tags = $tag->all();
		return view('topics.create_and_edit', compact('topic',"categories",'tags'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '成功删除！');
	}
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }

}