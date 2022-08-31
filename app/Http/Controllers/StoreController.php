<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Maker;
use App\Models\Type;
use App\Models\Item;

class StoreController extends Controller
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

    public function index(Request $request){

        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'maker_id' => 'required',
                'detail' => 'max:250',
            ],
            [
                'name.required' => '商品名を入力してください',
                'name.max' => '商品名を100文字以内で入力してください',
                'maker_id.required' => 'メーカーを選択してください',
                'detail.max' => '詳細を250文字以内で入力してください',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'maker_id' => $request->maker_id,
                'type_id' => $request->type_id,
                'detail' => $request->detail,
                'release_at' => $request->release_at,
            ]);

            return redirect()->route('item-home');
        }

        $makers = Maker::where('status', 'active')->orderby('name')->get();
        $types = Type::where('status', 'active')->orderby('name')->get();


        // 画面表示
        return view('store.index', compact('makers', 'types'));
    }

    /**
     * メーカー登録
     */

    public function makerAdd(Request $request)
    {
        if(Maker::where('status','null')->where('name', $request->maker)->first()){
            $id = Maker::where('status','null')->where('name', $request->maker)->first();
            Maker::where('id', $id->id)->update([
                'status' => 'active',
            ]);
            return redirect()->route('store');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:makers,name',
        ],
        [
            'name.required' => '入力内容を確認してください',
            'name.max' => '100文字以内で入力してください',
            'name.unique' => 'このメーカーは既に存在します',
        ])->validateWithBag('maker');

        Maker::create([
            'name'=>$request->maker,
        ]);
        // 画面表示
        return redirect()->route('store')->withErrors($validator, 'maker');
    }


    /**
     * メーカー更新
     */
    public function makerUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:makers,name',
        ],
        [
            'name.required' => '入力内容を確認してください',
            'name.max' => '100文字以内で入力してください',
            'name.unique' => 'このメーカーは既に存在します',
        ])->validateWithBag('maker');

        Maker::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('store')->withErrors($validator, 'maker');
    }
    /**
     * メーカー削除
     */
    public function makerDelete(Request $request, $id) 
    {
        Maker::where('id', $id)->update(['status' => 'null']);
        return redirect()->route('store');
    }

    /**
     * 種別登録
     */
    public function typeAdd(Request $request)
    {
        if(Type::where('status','null')->where('name', $request->type)->first()){
            $id = Type::where('status','null')->where('name', $request->type)->first();
            Type::where('id', $id->id)->update([
                'status' => 'active',
            ]);
            return redirect()->route('store');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:types,name',
        ],
        [
            'name.required' => '入力内容を確認してください',
            'name.max' => '100文字以内で入力してください',
            'name.unique' => 'この種別は既に存在します',
        ])->validateWithBag('type');


        Type::create([
            'name'=>$request->type,
        ]);
        // 画面表示
        return redirect()->route('store')->withErrors($validator, 'type');
    }

    /**
     * 種別更新
     */
    public function typeUpdate(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:types,name',
        ],
        [
            'name.required' => '入力内容を確認してください',
            'name.max' => '100文字以内で入力してください',
            'name.unique' => 'この種別は既に存在します',
        ])->validateWithBag('type');


        Type::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('store')->withErrors($validator, 'type');
    }
    /**
     * 種別削除
     */
    public function typeDelete($id) 
    {
        Type::where('id', $id)->update(['status' => 'null']);
        return redirect()->route('store');
    }

}