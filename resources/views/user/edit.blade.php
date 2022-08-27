@extends('adminlte::page')

@section('title', 'ユーザー編集')

@section('content_header')
    <h1>ユーザー編集</h1>
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

                <form method="POST" action="{{ route('user-update', ['id' => $user->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" required value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">メールアドレス</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email">
                        </div>
                        <div class="form-group">
                            <input id="admin-id-1" type="radio" name="admin_id" value="1" {{ $user->admin_id === 1? 'checked' : '' }}>
                            <label for="admin-id-1">管理者</label>
                            <input id="admin-id-0" type="radio" name="admin_id" value="0" {{ $user->admin_id === 0? 'checked' : '' }}>
                            <label for="admin-id-0">一般</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">変更</button>
                    </div>

                </form>

                <!-- 削除ボタン -->
                <form method="POST"  action="{{ route('user-delete', ['id' => $user->id]) }}" >
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