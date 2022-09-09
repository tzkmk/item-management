@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mb-2 earch-form text-center">
                    <form class="input-group d-flex justify-content-center" action="{{ route('users') }}" method="get">
                        @csrf
                        <!-- 絞り込み検索 -->
                        <div  class="d-block">
                            <label for="search-box">ユーザー検索</label>
                            <div id="search-box" class="mb-2 d-flex justify-content-center form-group">
                                <!-- 管理者権限 -->
                                <select class="mr-2 form-control" name="admin_id">
                                    <option value="">管理者権限</option>
                                    <option value="1" {{ (int)$admin_id === 1 ? 'selected' : '' }}>権限：有</option>
                                    <option value="2" {{ (int)$admin_id === 2 ? 'selected' : '' }}>権限：無</option>
                                </select>
                                <!-- キーワード検索 -->
                                <input class="form-control" type="text" name="keyword" placeholder="ユーザー名検索" value="{{ $keyword }}">
                            </div>
                        </div>
                        <div class="d-flex pt-3 p-2">
                            <button class="btn btn-sm btn-secondary mt-3" type="submit">検索</button>
                        </div>

                    </form>
                </div>
                    <!-- ページネーション -->
                    <div class="pagination justify-content-center">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>

                <!-- ユーザー一覧 -->
                <div class="card-body justify-content-center">
                @if(count($users)>0)
                    <table class="table table-sm table-bordered text-center table-hover">
                            <tr class="table-secondary">
                                <th>ID</th>
                                <th>名前</th>
                                <th>メールアドレス</th>
                                <th colspan="2">管理者権限</th>
                                <!-- <th></th> -->
                                <th>更新日</th>
                                <th></th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>@if($user->admin_id === 1) 管理者 @else - @endif</td>
                                    <td>
                                        @if($user->admin_id === 1)                                        
                                            <form action="{{ route('admin-delete', ['id' => $user->id]) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger" type="submit">権限削除</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin-update', ['id' => $user->id]) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-success" type="submit">権限付与</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{ date('Y/m/d', strtotime($user->updated_at)) }}</td>
                                    <td>
                                        <button class="modal_open btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#js-modal-{{ $user->id }}">削除</button>
                                        <!-- モーダル表示内容 -->
                                        <div class="modal fade" id="js-modal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content m-auto text-left">
                                                    <div class="modal-header d-flex justify-content-between">
                                                        <h3 class="modal-title">削除しますか？</h5>
                                                        <!-- 削除ボタン -->
                                                        <form method="POST" class="text-right" action="{{ route('user-delete', ['id' => $user->id]) }}" >
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger" >削除</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">名前</label>
                                                            <input type="text" class="form-control" id="name"  value="{{ $user->name }}" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">メールアドレス</label>
                                                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-dismiss="modal">閉じる</button>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>                                    
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                @else
                <p>一致するユーザーは存在しません</p>
                @endif
                </div>
            </div>

        </div>
    </div>

@stop

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

@stop