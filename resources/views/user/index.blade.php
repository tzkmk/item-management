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
                                    <option value="null" {{ $admin_id === 'null' ? 'selected' : '' }}>権限：無</option>
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

                <!-- ユーザー一覧 -->
                <div class="card-body justify-content-center">
                    <table class="table table-sm table-bordered text-center table-hover">
                            <tr class="table-secondary">
                                <th>ID</th>
                                <th>名前</th>
                                <th>メールアドレス</th>
                                <th colspan="2">管理者権限</th>
                                <!-- <th></th> -->
                                <th>更新日</th>
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
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop