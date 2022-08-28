@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
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

                <form method="POST" action="{{ route('update', ['id' => $item->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ $item->name }}">
                        </div>

                        <div class="form-group">
                            <label for="maker">メーカー</label>
                            <select class="form-control" name="maker">
                                <option value="">メーカーを選択</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}" {{ $item->maker_id === $maker->id? 'selected' : '' }}>{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" name="type">
                                <option value="">種別を選択</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $item->type_id === $type->id? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" name="detail" id="detail" cols="30" rows="5" placeholder="詳細説明">{{ $item->detail }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="release_at">発売日</label>
                            <input type="date" class="form-control" id="release_at" name="release_at"  value="{{ $item->release_at }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">変更</button>
                    </div>

                </form>

                <!-- 削除ボタン -->
                <form method="POST"  action="{{ route('delete', ['id' => $item->id]) }}" >
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
