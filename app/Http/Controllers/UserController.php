<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //ユーザー情報を取得してユーザー情報一覧に表示する
    public function index(Request $request){

        $users = User::all();

        //画面表示
        return view('user.index',compact('users'));
    }

    /**
     * ユーザー編集画面
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('user.edit', compact('user'));
    }

    /**
     * ユーザー更新
     */
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'admin_id' => (int)$request->admin_id,
        ]);

        return redirect()->route('users');
    }
    /**
     * ユーザー削除
     */
    public function delete($id) 
    {
        User::where('id', $id)->delete();
        return redirect()->route('users');
    }
}