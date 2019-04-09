<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth',['except'=>["show"]]);
    }

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
        $this->authorize("update",$user);
        return view('users.edit', compact('user'));
    }

    /**资料更新
     * @param UserRequest        $request
     * @param User               $user
     * @param ImageUploadHandler $upload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request,User $user,ImageUploadHandler $upload){
       $this->authorize("update",$user);
        $data = $request->all();
        if ($request->avatar){
            $result = $upload->save($request->avatar,"avatar",$user->id,416);
            if ($result){
                $data['avatar'] = $result["path"];
            }
        }
    $user->update($data);
    return redirect()->route("users.show",$user->id)->with("success","个人资料更新成功！");
    }
}
