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
                                <p class="text-secondary mb-1">一覧表示項目</p>
                                <div class="mb-2 ">
                                    @foreach($lists as $list)
                                    <label class="mr-2" for="{{ $list[0] }}"><input id="{{ $list[0] }}" type="checkbox" name="list_items[]" value="{{ $list[0] }}" {{ $list[2] === 'check'? 'checked' : '' }}>{{ $list[1] }}</label>
                                    @endforeach
                                </div>
                                @if ($errors->has('list_items'))
                                    <div class="alert alert-danger text-left w-75 m-auto">
                                        <ul>
                                            @foreach ($errors->get('list_items') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- 並べ替え -->
                                <p class="text-secondary mb-1">並べ替え</p>
                                <div class="mb-2 d-flex justify-content-center">
                                    <select name="sort" class="form-control form-control-sm w-25">
                                        <option value="id" {{ $sort === "id"? 'selected' : '' }} {{ old('sort') === "id"? 'selected' : '' }}>ID</option>
                                        <option value="name" {{ $sort === "name"? 'selected' : '' }} {{ old('sort') === "name"? 'selected' : '' }}>商品名</option>
                                        <option value="maker_name" {{ $sort === "maker_name"? 'selected' : '' }} {{ old('sort') === "maker_name"? 'selected' : '' }} >メーカー</option>
                                        <option value="type_name" {{ $sort === "type_name"? 'selected' : '' }} {{ old('sort') === "type_name"? 'selected' : '' }}>種別</option>
                                        <option value="release_at" {{ $sort === "release_at"? 'selected' : '' }} {{ old('sort') === "release_at"? 'selected' : '' }}>発売日</option>
                                        <option value="updated_at" {{ $sort === "updated_at"? 'selected' : '' }} {{ old('sort') === "updated_at"? 'selected' : '' }}>更新日</option>
                                    </select>
                                    <div class="ml-2 mt-1">
                                        <label class="mr-2" for="asc"><input id="asc" type="radio" name="order" value="asc" {{ $order === "asc"? 'checked' : '' }} {{ old('order') === "asc"? 'checked' : '' }}>昇順</label>
                                        <label for="desc"><input id="desc" type="radio" name="order" value="desc" {{ $order === "desc"? 'checked' : '' }} {{ old('order') === "desc"? 'checked' : '' }}>降順</label>
                                    </div>                                  
                                </div>
                            </div>
                            <div class="flex-fill d-block">
                                <!-- 絞り込み検索 -->
                                <p class="text-secondary">検索欄</p>
                                <div class="d-block">
                                    <!-- メーカー -->
                                    <div class="mb-2 d-flex justify-content-center form-group">
                                        <select class="mr-2 form-control form-control-sm" name="maker">
                                            <option value="">全てのメーカー</option>
                                            @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}" {{ (int)$maker_id === $maker->id? 'selected' : '' }} {{ (int)old('maker') === $maker->id? 'selected' : '' }}>{{ $maker->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- 種別 -->
                                        <select class="form-control form-control-sm" name="type">
                                            <option value="">全ての種別</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}"  {{ (int)$type_id === $type->id? 'selected' : '' }}  {{ (int)old('type') === $type->id? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- キーワード検索 -->
                                    <input class="form-control" type="text" name="keyword" placeholder="検索キーワード" value="{{ $keyword }}{{ old('keyword') }}">
                                    
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
                    <div class="card-body table-responsive p-0 m-0" >
                        @if(count($items)>0)
                        <table class="table table-hover table-sm table-bordered text-wrap" style="table-layout:fixed;">
                            <thead>
                                <tr class="table-secondary">
                                    @foreach($lists as $key => $list)
                                        <!-- @if($list[2] === 'check')
                                                <th>{{ $list[1] }}</th>
                                        @endif -->
                                        @if($list[2] === 'check' && ($list[0] !== 'name' && $list[0] !== 'detail'))
                                            <th class="p-2 col-1" style="width:80px;">{{ $list[1] }}</th>
                                        @elseif($list[2] === 'check')
                                            <th class=" p-2 col-1" style="width:200px;">{{ $list[1] }}</th>
                                        @endif
                                    @endforeach
                                    @if($user->admin_id === 1 )
                                        <th class="col-1" style="width:50px;"></th>
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
