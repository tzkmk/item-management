<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\User;
use App\Models\Maker;
use App\Models\Type;


class CalendarController extends Controller
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

                            
        // カレンダー表示用の日付取得
        $month = $request->month;
        if(!isset($month)){
            $month = date('Y-m');
        }
        $date = $month . '-01';
        $count_month_day = date('t', strtotime($date));
        $start_day_week = date('w', strtotime('first day of' . $date));
        $end_day_week = date('w', strtotime('last day of' . $date));
        $days = [];
        // 月初までの空欄用に空白を格納
        for($null_start = 1; $null_start <= $start_day_week; $null_start++){
            $days[] = "";
        }
        // 当月の日数を配列に格納
        for($day = 1; $day <= $count_month_day; $day++){
            $days[] = $day;
        }
        // 月末以降の空欄用に空白を格納
        for($null_end = 1; $null_end <= 6-$end_day_week; $null_end++){
            $days[] = "";
        }
        // 一次元配列を二次元配列に変換
        $weeks = array_chunk($days, 7);

        // 一覧取得
        $users = User::select('id AS user_id', 'name AS user_name');
        $makers = Maker::select('id AS maker_id', 'name AS maker_name');
        $types = Type::select('id AS type_id', 'name AS type_name');
        $items = Item::where('status', 'active')
                        ->where('release_at','LIKE',"%{$month}%")
                        ->leftjoinSub($users, 'users', function ($join) {
                            $join->on('items.user_id', '=', 'users.user_id');
                            })
                        ->leftjoinSub($makers, 'makers', function ($join) {
                            $join->on('items.maker_id', '=', 'makers.maker_id');
                            })
                        ->leftjoinSub($types, 'types', function ($join) {
                            $join->on('items.type_id', '=', 'types.type_id');
                            })->get();

        // 画面表示
        return view('calendar.index', compact('items', 'weeks', 'month'));
    }

}