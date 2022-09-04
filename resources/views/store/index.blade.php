@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@stop

@section('content')
    <div class="row d-flex justify-content-around">

        <!-- 商品登録 -->
        <div class="col-md-6">

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="maker">メーカー</label>
                            <select class="form-control" id="maker" name="maker_id">
                                <option value="">メーカーを選択</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}" {{ (int)old('maker_id') === $maker->id? 'selected': '' }}>{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" id="type" name="type_id">
                                <option value="">種別を選択</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ (int)old('type_id') === $type->id? 'selected': '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" name="detail" id="detail" cols="30" rows="5" placeholder="詳細説明" value="{{ old('detail') }}"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="release_at">発売日</label>
                            <input type="date" class="form-control" id="release_at" name="release_at" value="{{ old('release_at') }}">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success mt-3">登録</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

        <div class="col-md-6 d-flex">
            <!-- メーカー一覧 -->
            <div class="d-block col-6">
                <h4 class=" text-center">メーカー一覧</h4>
                <div class="mb-2">
                    <form class="input-group d-flex justify-content-center" action="{{ route('maker-add') }}" method="post">
                        @csrf 
                            <input class="form-control" name="maker" type="text" placeholder="メーカーを入力" value="{{ old('maker') }}">
                            <button class="btn btn-sm btn-secondary" type="submit">追加</button>
                    </form>
                </div>
                @foreach($makers as $maker)
                <ul class="mb-0">
                    <li><a class="modal_open link text-dark" data-bs-toggle="modal" data-bs-target="#maker-modal-{{ $maker->id }}" href="#">{{$maker->name}}</a></li>
                </ul>
                <!-- モーダル表示内容 -->
                <div class="modal fade" id="maker-modal-{{ $maker->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content w-75 m-auto">
                            <div class="modal-header d-flex justify-content-between">
                                <h3 class="modal-title">メーカー編集</h3>
                                <!-- 削除ボタン -->
                                <form method="POST"  action="{{ route('maker-delete', ['id' => $maker->id]) }}" >
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" >削除</button>
                                </form>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('maker-update', ['id' => $maker->id])}}">
                                    @csrf
                                    <div class="w-75 m-auto text-start">
                                       <label for="maker">メーカー名</label>
                                        <input id="name" name="edit_maker" class="w-100" type="text" value="{{ $maker->name }}">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-success mt-3">変更</button>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer justify-content-right">
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-dismiss="modal">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    
            <!-- 種別一覧 -->
            <div class="d-block col-6">
                <h4 class=" text-center">種別一覧</h4>
                <div class="mb-2">
                    <form class="input-group d-flex justify-content-center" action="{{ route('type-add') }}" method="post">
                        @csrf 
                        <input class="form-control" name="type" type="text" placeholder="種別を入力" value="{{ old('type') }}">
                        <button class="btn btn-sm btn-secondary" type="submit">追加</button>
                    </form>
                </div>
                @foreach($types as $type)
                <ul class="mb-0">
                    <li><a class="modal_open link text-dark" data-bs-toggle="modal" data-bs-target="#type-modal-{{ $type->id }}" href="#">{{$type->name}}</a></li>
                </ul>
                <!-- モーダル表示内容 -->
                <div class="modal fade" id="type-modal-{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content w-75 m-auto">
                            <div class="modal-header d-flex justify-content-between">
                                <h3 class="modal-title">種別編集</h3>
                                <!-- 削除ボタン -->
                                <form method="POST"  action="{{ route('type-delete', ['id' => $type->id]) }}" >
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" >削除</button>
                                </form>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('type-update', ['id' => $type->id])}}">
                                    @csrf
                                    <div class="w-75 m-auto text-start">
                                        <label for="type">種別名</label>
                                        <input id="type" name="edit_type" class="w-100" type="text" value="{{ $type->name }}">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-success mt-3">変更</button>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer justify-content-right">
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-dismiss="modal">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
