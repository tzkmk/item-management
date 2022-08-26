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

        $makers = Maker::where('status', 'active')->get();
        $types = Type::where('status', 'active')->get();


        // 画面表示
        return view('store.index', compact('makers', 'types'));
    }

    public function makerAdd(Request $request){
        Maker::create([
            'name'=>$request->maker,
        ]);
        // 画面表示
        return redirect()->route('store');
    }

    public function typeAdd(Request $request){
        Type::create([
            'name'=>$request->type,
        ]);
        // 画面表示
        return redirect()->route('store');
    }

}