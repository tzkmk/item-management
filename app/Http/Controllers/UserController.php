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

        //Users(Model)テーブルに入っているレコードを全て取得する
        $users = User::all();

        //画面に渡す(.で中のファイルを示す)
        return view('user.index',compact('users'));
    }
}