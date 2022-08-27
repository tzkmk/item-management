@extends('adminlte::page')

@section('title', 'メーカー・種別')

@section('content_header')
    <h1>メーカー・種別</h1>
@stop

@section('content')
    <div class="d-flex justify-content-around">
        <!-- メーカー一覧 -->
        <div class="d-block">
            <p>メーカー一覧</p>
            <div>
                <form action="{{ route('maker-add') }}" method="post">
                    @csrf 
                    <input name="maker" type="text" placeholder="メーカー名を入力">
                    <button type="submit">追加</button>
                </form>
            </div>
            @foreach($makers as $maker)
            <ul class="mb-0">
                <li><a class="modal_open link" data-bs-toggle="modal" data-bs-target="#maker-modal-{{ $maker->id }}" href="#">{{$maker->name}}</a></li>
            </ul>
            <!-- モーダル表示内容 -->
            <div class="modal fade" id="maker-modal-{{ $maker->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content w-75 m-auto">
                        <div class="modal-header d-flex justify-content-between">
                            <h3 class="modal-title">メーカー編集</h5>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('maker-update', ['id' => $maker->id])}}">
                                @csrf
                                <div class="w-75 m-auto text-start">
                                    <p class="mb-0">メーカー名</p>
                                    <input name="name" class="w-100" type="text" value="{{ $maker->name }}">
                                </div>
                                <button type="submit" class="btn btn-primary" >変更</button>
                            </form>
                            <!-- 削除ボタン -->
                            <form method="POST"  action="{{ route('maker-delete', ['id' => $maker->id]) }}" >
                                @csrf
                                <button type="submit" class="btn btn-danger" >削除</button>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- 種別一覧 -->
        <div class="d-block">
            <p>種別一覧</p>
            <div>
                <form action="{{ route('type-add') }}" method="post">
                    @csrf 
                    <input name="type" type="text" placeholder="種別を入力">
                    <button type="submit">追加</button>
                </form>
            </div>
            @foreach($types as $type)
            <ul class="mb-0">
                <li><a class="modal_open link" data-bs-toggle="modal" data-bs-target="#type-modal-{{ $type->id }}" href="#">{{$type->name}}</a></li>
            </ul>
            <!-- モーダル表示内容 -->
            <div class="modal fade" id="type-modal-{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content w-75 m-auto">
                        <div class="modal-header d-flex justify-content-between">
                            <h3 class="modal-title">種別編集</h5>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('type-update', ['id' => $type->id])}}">
                                @csrf
                                <div class="w-75 m-auto text-start">
                                    <p class="mb-0">種別名</p>
                                    <input name="name" class="w-100" type="text" value="{{ $type->name }}">
                                </div>
                                <button type="submit" class="btn btn-primary" >変更</button>
                            </form>
                            <!-- 削除ボタン -->
                            <form method="POST"  action="{{ route('type-delete', ['id' => $type->id]) }}" >
                                @csrf
                                <button type="submit" class="btn btn-danger" >削除</button>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    

@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

@stop
