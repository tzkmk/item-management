@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
    <!-- ユーザー一覧 -->
    <div class="row justify-content-center">
        <table class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>権限</th>
                    <th>更新日</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->admin_id === 1) 管理者 @else - @endif</td>
                        <td>{{ date('Y-m-d', strtotime($user->updated_at)) }}</td>
                        <td>                                        
                            <form action="{{ route('user-edit', ['id' => $user->id]) }}" method="get">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger" type="submit">編集</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </thead>
        </table>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop