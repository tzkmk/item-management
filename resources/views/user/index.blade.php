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
                    <!-- <th>権限</th> -->
                    <th>更新日</th>
                </tr>
                @foreach($users as $u)
                    <tr>
                        
                        <td>{{$u->id}}</td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <!-- <td>@if($u->admine_id == 1) 管理者 @else - @endif</td> -->
                        <!-- <td>{{$u->updated_at}}</td> -->
                        <td>{{ $u->updated_at->format('Y/m/d') }}</td>

                        <!-- <td><a href="/user/edit/{{$u->id}}"> 編集 </a></td> -->
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