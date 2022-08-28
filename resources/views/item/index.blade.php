@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
    <input type="submit" value="このページを印刷する" onclick="window.print();">
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 商品検索 -->
                <div class="main text-center">
                    <div class="search-form mb-3 m-auto border-bottom">
                        <form class="input-group d-block" action="{{ route('item-home') }}" method="get">
                            @csrf
                            <!-- 並べ替え -->
                            <label for="sort-box">並べ替え</label>
                            <div id="sort-box" class="mb-2 ">
                                <select name="sort">
                                    <option value="id" {{ $sort === "id"? 'selected' : '' }}>商品コード</option>
                                    <option value="name" {{ $sort === "name"? 'selected' : '' }}>商品名</option>
                                    <option value="maker_name" {{ $sort === "maker_name"? 'selected' : '' }}>メーカー</option>
                                    <option value="type_name" {{ $sort === "type_name"? 'selected' : '' }}>種別</option>
                                    <option value="release_at" {{ $sort === "release_at"? 'selected' : '' }}>発売日</option>
                                    <option value="updated_at" {{ $sort === "updated_at"? 'selected' : '' }}>更新日</option>
                                </select>
                                <input type="radio" name="order" value="asc" {{ $order === "asc"? 'checked' : '' }}>昇順
                                <input type="radio" name="order" value="desc" {{ $order === "desc"? 'checked' : '' }}>降順
                            </div>

                            <!-- 絞り込み検索 -->
                            <label for="search-box">検索欄</label>
                            <div class="d-flex mb-2" id="search-box">
                                <!-- メーカー -->
                                <select class="form-control ms-2 me-2 col-3" name="maker">
                                    <option value="">全てのメーカー</option>
                                    @foreach($makers as $maker)
                                    <option value="{{ $maker->id }}" {{ $maker_id == $maker->id? 'selected' : '' }}>{{ $maker->name }}</option>
                                    @endforeach
                                </select>
                                <!-- 種別 -->
                                <select class="form-control me-2 col-3" name="type">
                                    <option value="">全ての種別</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}"  {{ $type_id == $type->id? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <!-- キーワード検索 -->
                                <input class="form-control me-2" type="text" name="keyword" placeholder="検索キーワード" value="{{ $keyword }}">
                                <button class="search-btn btn btn-sm btn-secondary me-2" type="submit">検索</button>
                            </div>
                        </form>
                    </div>
                    @if(count($items)>0)
                    <p class="text-start ms-2">商品数 : {{ count($items) }}点</p>
                    @endif
                    <!-- ページネーション -->
                    <div class="pagination justify-content-center">
                        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>

                    <!-- 商品テーブル -->
                    <div class="card-body table-responsive p-0">
                        @if(count($items)>0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名前</th>
                                    <th>メーカー</th>
                                    <th>種別</th>
                                    <th>詳細</th>
                                    <th>発売日</th>
                                    <th>更新日</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->maker_name }}</td>
                                        <td>{{ $item->type_name }}</td>
                                        <td>{{ $item->detail }}</td>
                                        <td>{{ $item->release_at }}</td>
                                        <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                                        <td>
                                            <form action="{{ route('edit', ['id' => $item->id]) }}" method="get">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger" type="submit">編集</button>
                                            </form>
                                        </td>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

@stop

@section('js')
@stop
