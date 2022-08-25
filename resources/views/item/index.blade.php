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
                    <div class="search-form mb-3 m-auto ">
                        <form class="input-group d-block" action="{{ route('item-home') }}" method="get">
                            @csrf
                            <div class="sort-box mb-2">
                                <select name="sort">
                                    <option value="id" {{ $sort === "id"? 'selected' : '' }}>商品コード</option>
                                    <option value="type" {{ $sort === "type"? 'selected' : '' }}>種別</option>
                                    <option value="name" {{ $sort === "name"? 'selected' : '' }}>商品名</option>
                                    <option value="updated_at" {{ $sort === "updated_at"? 'selected' : '' }}>更新日</option>
                                </select>
                                <input type="radio" name="order" value="asc" {{ $order === "asc"? 'checked' : '' }}>昇順
                                <input type="radio" name="order" value="desc" {{ $order === "desc"? 'checked' : '' }}>降順
                            </div>
                            <div class="search-box d-flex">
                                <input class="form-control me-2" type="text" name="keyword" placeholder="検索キーワード" value="{{ $keyword }}">
                                <button class="search-btn btn btn-sm btn-secondary" type="submit">検索</button>
                            </div>
                        </form>
                    </div>
                    @if($keyword && $keyword !== " ")
                    <p>「{{ $keyword }}」の検索結果</p>
                    @endif
                    <!-- ページネーション -->
                    <div class="pagination justify-content-center">
                        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>

                    <!-- 商品テーブル -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名前</th>
                                    <th>種別</th>
                                    <th>詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->detail }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
