@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body justify-content-center">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>メールアドレス</th>
                                <th>管理者権限</th>
                                <th></th>
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
                                    <td>{{ date('Y-m-d', strtotime($user->updated_at)) }}</td>
                                </tr>
                            @endforeach
                        </thead>
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