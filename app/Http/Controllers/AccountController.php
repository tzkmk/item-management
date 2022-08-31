<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
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

    /**
     * ユーザー編集画面
     */
    public function index(Request $request)
    {
        $user_id = \Auth::id();
        $user = User::where('id', $user_id)->first();


        return view('account.index', compact('user'));
    }


    /**
     * ユーザー更新
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['string', 'min:8', 'nullable'],
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // パスワードが入力された時、 ハッシュ化して更新
        if (isset($request->password) && $request->password != "") {
            $password = Hash::make($request->password);
            User::where('id', $id)->update([
                'password' => $password,
            ]);
        }

        return redirect()->route('account');
    }

    /**
     * ユーザー削除
     */
    public function delete($id) 
    {
        User::where('id', $id)->delete();
        return redirect()->route('account');
    }
}