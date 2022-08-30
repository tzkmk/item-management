@extends('adminlte::page')

@section('title', 'アカウント情報')

@section('content_header')
    <h1>アカウント情報</h1>
@stop

@section('content')
<div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">

                <form method="POST" action="{{ route('account-update', ['id' => $user->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" required value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを変更する場合は、入力してください">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">変更</button>
                    </div>

                </form>

                <!-- 削除ボタン -->
                <form method="POST"  action="{{ route('account-delete', ['id' => $user->id]) }}" >
                    @csrf
                    <button type="submit" class="btn btn-danger" >削除</button>
                </form>

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop