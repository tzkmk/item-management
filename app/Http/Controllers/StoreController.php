<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Maker;
use App\Models\Type;

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

        $makers = Maker::where('status', 'active')->orderby('name')->get();
        $types = Type::where('status', 'active')->orderby('name')->get();


        // 画面表示
        return view('store.index', compact('makers', 'types'));
    }

    /**
     * メーカー登録
     */

    public function makerAdd(Request $request){
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
        $validated = $request->validate([
            'name' => 'required',
        ]);
        Maker::where('id', $id)->update([
            'name' => $request->name,
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
    public function typeAdd(Request $request){
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
        $validated = $request->validate([
            'name' => 'required',
        ]);
        Type::where('id', $id)->update([
            'name' => $request->name,
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