@extends('adminlte::page')

@section('title', 'ホーム')

@section('content_header')
    <h1>ホーム</h1>
@stop

@section('content')
    <p>商品管理システムへようこそ</p>
    <p>以下の機能を利用できます。</p>
    <ul>
        <li class="mb-2"> 
            <div>
                <p class="m-0">商品一覧</p>
                <div>登録中の商品を閲覧できます。<br>商品の絞り込み、検索も行えます。</div>
            </div>
        </li>
        <li class="mb-2"> 
            <div>
                <p class="m-0">カレンダー</p>
                <div>発売日を登録した商品をカレンダーに表示できます。</div>
            </div>
        </li>
        <li class="mb-2"> 
            <div>
                <p class="m-0">アカウント情報</p>
                <div>アカウント情報の閲覧、編集を行えます。</div>
            </div>
        </li>
        <li class="mb-2"> 
            <div>
                <p class="m-0">商品登録</p>
                <div>商品の登録を行えます。</div>
                @if($user->admin_id !== 1)
                    <div class="text-danger">管理者権限を所持していないため、現在は利用できません。</div>
                @endif
            </div>
        </li>
        <li class="mb-2"> 
            <div>
                <p class="m-0">ユーザー一覧</p>
                <div>登録中のユーザーを確認できます。<br>管理者権限の付与も行えます。</div>
                @if($user->admin_id !== 1)
                    <div class="text-danger">管理者権限を所持していないため、現在は利用できません。</div>
                @endif
            </div>
        </li>
    </ul>

    <!-- <p>Welcome to this beautiful admin panel.</p> -->
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

