<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $validated = $request->validate([
            'maker' => 'required|max:100|unique:makers,name',
        ],
        [
            'maker.required' => 'メーカー名を入力してください',
            'maker.max' => '100文字以内で入力してください',
            'maker.unique' => $request->maker.'は既に登録されています',

        ]);

        Maker::create([
            'name'=>$request->maker,
        ]);
        // 画面表示
        return redirect()->route('store');
    }


    /**
     * メーカー更新
     */
    public function makerUpdate(Request $request, $id)
    {
        if(Maker::where('status','null')->where('name', $request->maker)->first()){
            $id = Maker::where('status','null')->where('name', $request->maker)->first();
            Maker::where('id', $id->id)->update([
                'status' => 'active',
            ]);
            return redirect()->route('store');
        }

        $validated = $request->validate([
            'edit_maker' => 'required|max:100|unique:makers,name,'.$id.',id',
        ],
        [
            'edit_maker.required' => 'メーカー名を入力してください',
            'edit_maker.max' => '100文字以内で入力してください',
            'edit_maker.unique' => $request->edit_maker.'は既に存在します',

        ]);

        Maker::where('id', $id)->update([
            'name' => $request->edit_maker,
        ]);

        return redirect()->route('store');
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

        $validated = $request->validate([
            'type' => 'required|max:100|unique:types,name',
        ],
        [
            'type.required' => '種別名を入力してください',
            'type.max' => '100文字以内で入力してください',
            'type.unique' => $request->type.'は既に存在します',
        ]);


        Type::create([
            'name'=>$request->type,
        ]);
        // 画面表示
        return redirect()->route('store');
    }

    /**
     * 種別更新
     */
    public function typeUpdate(Request $request, $id)
    {
        if(Type::where('status','null')->where('name', $request->type)->first()){
            $id = Type::where('status','null')->where('name', $request->type)->first();
            Type::where('id', $id->id)->update([
                'status' => 'active',
            ]);
            return redirect()->route('store');
        }
        
        $validated = $request->validate([
            'edit_type' => 'required|max:100|unique:types,name,'.$id.',id',
        ],
        [
            'edit_type.required' => '種別名を入力してください',
            'edit_type.max' => '100文字以内で入力してください',
            'edit_type.unique' => $request->edit_type.'は既に存在します',
        ]);

        Type::where('id', $id)->update([
            'name' => $request->edit_type,
        ]);

        return redirect()->route('store');
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