@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="maker">メーカー</label>
                            <select class="form-control" name="maker">
                                <option value="">メーカーを選択</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" name="type">
                                <option value="">種別を選択</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" name="detail" id="detail" cols="30" rows="5" placeholder="詳細説明"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="release_at">発売日</label>
                            <input type="date" class="form-control" id="release_at" name="release_at">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
