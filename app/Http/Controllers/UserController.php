<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        $user = \Auth::user();
        return view('user.setting', compact('user'));
    }

    //个人设置行为
    public function settingStore(Request $request)
    {
        //验证
        $this->validate(request(), [
            'name' => 'required|min:3',
        ]);

        //逻辑
        $name = request('name');
        $user = \Auth::user();
        if ($name != $user->name) {
            if (User::where('name', $name)->count() > 0) {
                return back()->withErrors('用户名已被注册');
            }
            $user->name = $name;
        }

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly($user->id);
            $user->avatar = "/storage/".$path;
        }

        $user->save();

        return back();
        //渲染
    }

}
