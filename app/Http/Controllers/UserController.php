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

                // 検索キーワード取得
                $keyword = mb_convert_kana($request->keyword, 'sa'); 
                $keywords = explode(" ", $keyword);
                if(!empty(preg_grep("#\\\#", $keywords))){
                    $keywords = str_replace( "\\" ,  "\\\\" , $keywords);
                }
                $query = User::query();
                if($keyword){
                    foreach($keywords as $value) {
                        $query->where('name','LIKE',"%{$value}%");
                    }
                }
        
                // 権限絞り込み
                $admin_id = '';
                if($request->admin_id){
                    $admin_id = $request->admin_id;
                    $query->where('admin_id', $admin_id);
                }

        $users = $query->orderby('id' , 'asc')->get();

        //画面表示
        return view('user.index',compact('users', 'admin_id', 'keyword'));
    }

    /**
     * 権限付与
     */
    public function update(Request $request, $id)
    {
        User::where('id', $id)->update([
            'admin_id' => 1,
        ]);
        return redirect()->route('users');
    }

    /**
     * 権限削除
     */
    public function delete($id) 
    {
        User::where('id', $id)->update([
            'admin_id' => 0,
        ]);
        return redirect()->route('users');
    }

}