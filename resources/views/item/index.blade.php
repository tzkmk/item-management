@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
<div class="d-flex justify-content-between">
        <h1>商品一覧</h1>
        <input type="submit" value="このページを印刷する" onclick="window.print();">
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mb-2 earch-form text-center">
                    <form class="input-group d-block" action="{{ route('item-home') }}" method="get">
                        @csrf
                        <div class="d-flex m-2">
                            <div class="flex-fill d-block">
                                <!-- 一覧表示項目 -->
                                <label for="sort-box">一覧表示項目</label>
                                <div id="sort-box" class="mb-2 ">
                                    @foreach($lists as $list)
                                        <input type="checkbox" name="list_items[]" value="{{ $list[0] }}" {{ $list[2] === 'check'? 'checked' : '' }}>{{ $list[1] }}
                                    @endforeach
                                </div>

                                <!-- 並べ替え -->
                                <label for="sort-box">並べ替え</label>
                                <div id="sort-box" class="mb-2 ">
                                    <select name="sort">
                                        <option value="id" {{ $sort === "id"? 'selected' : '' }}>ID</option>
                                        <option value="name" {{ $sort === "name"? 'selected' : '' }}>商品名</option>
                                        <option value="maker_name" {{ $sort === "maker_name"? 'selected' : '' }}>メーカー</option>
                                        <option value="type_name" {{ $sort === "type_name"? 'selected' : '' }}>種別</option>
                                        <option value="release_at" {{ $sort === "release_at"? 'selected' : '' }}>発売日</option>
                                        <option value="updated_at" {{ $sort === "updated_at"? 'selected' : '' }}>更新日</option>
                                    </select>
                                    <input type="radio" name="order" value="asc" {{ $order === "asc"? 'checked' : '' }}>昇順
                                    <input type="radio" name="order" value="desc" {{ $order === "desc"? 'checked' : '' }}>降順
                                </div>
                            </div>
                            <div class="flex-fill d-block">
                                <!-- 絞り込み検索 -->
                                <label for="search-box">検索欄</label>
                                <div class="d-block" id="search-box">
                                    <!-- メーカー -->
                                    <div class="mb-2 d-flex justify-content-center">
                                        <select class="mr-2" name="maker">
                                            <option value="">全てのメーカー</option>
                                            @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}" {{ (int)$maker_id === $maker->id? 'selected' : '' }}>{{ $maker->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- 種別 -->
                                        <select  name="type">
                                            <option value="">全ての種別</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}"  {{ (int)$type_id === $type->id? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- キーワード検索 -->
                                    <input class="form-control" type="text" name="keyword" placeholder="検索キーワード" value="{{ $keyword }}">
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-secondary mb-2" type="submit">一覧表示</button>
                    </form>
                </div>

                <!-- 商品検索 -->
                <div class="main text-center">
                    @if(!empty($keyword) || !empty($maker_id) || !empty($type_id))
                    <p class="text-left ml-2">検索一致商品数 : 全 {{ $all_item }} 件中 {{ $count_item }} 件</p>
                    @else(count($items)>0)
                    <p class="text-left ml-2">登録商品数 :  全 {{ $all_item }} 件</p>                    
                    @endif
                    <!-- ページネーション -->
                    <div class="pagination justify-content-center">
                        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>

                    <!-- 商品テーブル -->
                    <div class="card-body table-responsive p-0">
                        @if(count($items)>0)
                        <table class="table table-hover table-sm table-bordered text-wrap">
                            <thead>
                                <tr class="table-secondary">
                                    @foreach($lists as $key => $list)
                                        <!-- @if($list[2] === 'check')
                                                <th>{{ $list[1] }}</th>
                                        @endif -->
                                        @if($list[2] === 'check' && ($list[0] !== 'name' && $list[0] !== 'detail'))
                                            <th class="p-2">{{ $list[1] }}</th>
                                        @elseif($list[2] === 'check')
                                            <th class="w-25 p-2">{{ $list[1] }}</th>
                                        @endif
                                    @endforeach
                                    @if($user->admin_id === 1 )
                                        <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        @foreach($lists as $key => $list)
                                            @if($list[2] === 'check' && ($list[0] !== 'updated_at' && $list[0] !== 'release_at' && $list[0] !== 'id'))
                                                <td class="p-1 align-middle text-left">{{ $item->$key }}</td>
                                            @elseif($list[2] === 'check')
                                                @if($list[0] !== 'id' && $item->$key !== null)
                                                <td class="p-1 align-middle">{{ date('Y/m/d', strtotime($item->$key)) }}</td>
                                                @else
                                                <td class="p-1 align-middle">{{ $item->$key }}</td>
                                                @endif                                      
                                            @endif
                                        @endforeach

                                        @if($user->admin_id === 1 )
                                            <td class="p-1 align-middle">
                                                <form action="{{ route('edit', ['id' => $item->id]) }}" method="get">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-success" type="submit">編集</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>一致する商品はありません</p>
                        @endif
                    </div>
                </div> 
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@stop

@section('js')
@stop
