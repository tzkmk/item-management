@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-light">
                <div class="card-header">
                    <!-- 削除ボタン -->
                    <div class="text-right mb-2" >
                        <form method="POST" action="{{ route('delete', ['id' => $item->id]) }}" >
                            @csrf
                            <button type="submit" class="btn  btn-outline-danger" >削除</button>
                        </form>
                    </div>
                </div>

                <form method="POST" action="{{ route('update', ['id' => $item->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="商品名" value="{{ $item->name }}">
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
                            <label for="maker">メーカー</label>
                            <select class="form-control" name="maker">
                                <option value="">メーカーを選択</option>
                                @foreach($makers as $maker)
                                <option value="{{ $maker->id }}" {{ $item->maker_id === $maker->id? 'selected' : '' }}>{{ $maker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('maker'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('maker') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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
                        @if ($errors->has('detail'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->get('detail') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="release_at">発売日</label>
                            <input type="date" class="form-control" id="release_at" name="release_at"  value="{{ $item->release_at }}">
                        </div>
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
