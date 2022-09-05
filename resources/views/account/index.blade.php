@extends('adminlte::page')

@section('title', 'アカウント情報')

@section('content_header')
    <h1>アカウント情報</h1>
@stop

@section('content')
<div class="row">
        <div class="col-md-8 m-auto">
            <div class="card card-light">
                <div class="card-header">
                    <!-- 削除ボタン -->
                    <form method="POST" class="text-right" action="{{ route('account-delete', ['id' => $user->id]) }}" >
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" >削除</button>
                    </form>
                </div>

                <form method="POST" action="{{ route('account-update', ['id' => $user->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ $user->name }}">
                        </div>
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->get('name') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" autocomplete="email">
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->get('email') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="パスワードを変更する場合は、入力してください">
                        </div>
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->get('password') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success mt-3">変更</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@stop

@section('js')
@stop