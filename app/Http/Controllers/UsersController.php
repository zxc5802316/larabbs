<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**显示个人资料
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user){
        return view('users.show', compact('user'));
    }

    /**编辑个人资料
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }
    public function update(UserRequest $request,User $user,ImageUploadHandler $upload){
        $data = $request->all();
        if ($request->avatar){
            $result = $upload->save($request->avatar,"avatar",$user->id);
            if ($result){
                $data['avatar'] = $result["path"];
            }
        }
    $user->update($data);
    return redirect()->route("users.show",$user->id)->with("success","个人资料更新成功！");
    }
}
