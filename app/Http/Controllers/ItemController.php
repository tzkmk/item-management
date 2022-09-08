<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Maker;
use App\Models\Type;

class ItemController extends Controller
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
     * 商品一覧を取得し、一覧画面を表示
     */
    public function index(Request $request){
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'list_items' => 'required',
            ]);
        }

        $user = User::where('id', Auth::id())->first();

        // 一覧表示項目選択
        $lists = [
            'id' => ['id', 'ID', 'check'],
            'name' => ['name', '商品名', 'check'],
            'maker_name' => ['maker_name', 'メーカー', 'check'],
            'type_name' => ['type_name', '種別', 'check'],
            'detail' => ['detail', '詳細', 'check'],
            'updated_at' => ['updated_at', '更新日', 'check'],
            'release_at' => ['release_at', '発売日', 'check'],
        ];
        if($request->list_items){
            foreach($lists as &$list){
            $list[2] = 'uncheck';
            }
            foreach($request->list_items as $list_item){
                $lists[$list_item][2] = 'check';
            }
        }

        // 並べ替え
        $sort = 'id';
        $order = 'asc';
        if($request->sort){
            $sort = $request->sort;
            $order = $request->order;
        }

        // 検索キーワード取得
        $keyword = mb_convert_kana($request->keyword, 'sa'); 
        $keywords = explode(" ", $keyword);
        if(!empty(preg_grep("#\\\#", $keywords))){
            $keywords = str_replace( "\\" ,  "\\\\" , $keywords);
        }
        $query = Item::query();
        if($keyword){
            foreach($keywords as $value) {
                $query->where('status', 'active')
                        ->where(function($query) use ($value) {
                            $query->orwhere('id',  'LIKE', $value)
                                ->orWhere('name','LIKE',"%{$value}%")
                                ->orWhere('detail','LIKE',"%{$value}%");
                        });
            }
        }

        // メーカー・種別絞り込み
        $maker_id = '';
        if($request->maker){
            $maker_id = $request->maker;
            $query->where('items.maker_id', $maker_id);
        }
        $type_id = '';
        if($request->type){
            $type_id = $request->type;
            $query->where('items.type_id', $type_id);
        }
        
        // ユーザー名を結合して、商品一覧取得
        $users = User::select('id AS user_id', 'name AS user_name');
        $makers = Maker::select('id AS maker_id', 'name AS maker_name');
        $types = Type::select('id AS type_id', 'name AS type_name');
        $count_item = $query->count();
        $items = $query->leftjoinSub($users, 'users', function ($join) {
                            $join->on('items.user_id', '=', 'users.user_id');
                            })
                        ->leftjoinSub($makers, 'makers', function ($join) {
                            $join->on('items.maker_id', '=', 'makers.maker_id');
                            })
                        ->leftjoinSub($types, 'types', function ($join) {
                            $join->on('items.type_id', '=', 'types.type_id');
                            })
                        ->orderby($sort , $order)
                        ->paginate(8);

        $all_item = Item::where('status', 'active')->count();
        $makers = Maker::where('status', 'active')->orderby('name')->get();
        $types = Type::where('status', 'active')->orderby('name')->get();

        // 画面表示
        return view('item.index', compact('items', 'all_item','count_item','keyword', 'order', 'sort', 'makers', 'types', 'maker_id', 'type_id', 'lists','user'));
    }

    /**
     * 商品編集画面
     */
    public function edit($id)
    {
        $item = Item::where('status', 'active')->where('id', $id)->first();
        $makers = Maker::where('status', 'active')->orderby('name')->get();
        $types = Type::where('status', 'active')->orderby('name')->get();

        return view('item.edit', compact('item', 'makers', 'types'));
    }

    /**
     * 商品更新
     */
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $validated = $request->validate([
            'name' => 'required|max:100',
            'maker' => 'required',
            'detail' => 'max:250',
        ],
        [
            'name.required' => '商品名を入力してください',
            'name.max' => '商品名を100文字以内で入力してください',
            'maker.required' => 'メーカーを選択してください',
            'detail.max' => '詳細を250文字以内で入力してください',
        ]);
        
        Item::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'maker_id' => $request->maker,
            'type_id' => $request->type,
            'detail' => $request->detail,
            'release_at' => $request->release_at,
        ]);

        return redirect()->route('item-home');
    }
    /**
     * 商品削除
     */
    public function delete(Request $request, $id) 
    {
        Item::where('id', $id)->update(['status' => 'null']);
        return redirect()->route('item-home');
    }
}
