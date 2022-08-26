@extends('adminlte::page')

@section('title', 'メーカー・種別登録')

@section('content_header')
    <h1>メーカー・種別登録</h1>
@stop

@section('content')
    <div class="d-flex justify-content-around">
        <!-- メーカー一覧 -->

        <div class="row justify-content-center">
            <p>メーカー一覧</p>
            <div>
                <form action="{{ route('maker-add') }}" method="post">
                    @csrf 
                    <input name="maker" type="text" placeholder="メーカー名を入力">
                    <button type="submit">追加</button>
                </form>
            </div>
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    @foreach($makers as $maker)
                        @if($maker->id%2 !== 0)
                            <tr>
                                <td>{{$maker->name}}</td>
                        @else
                                <td>{{$maker->name}}</td>
                            </tr>
                        @endif
                    @endforeach
                </thead>
            </table>
        </div>

        <!-- 種別一覧 -->
        <div class="row justify-content-center">
            <p>種別一覧</p>
            <div>
                <form action="{{ route('type-add') }}" method="post">
                    @csrf 
                    <input name="type" type="text" placeholder="種別を入力">
                    <button type="submit">追加</button>
                </form>
            </div>
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    @foreach($types as $type)
                        @if($type->id%2 !== 0)
                            <tr>
                                <td>{{$type->name}}</td>
                        @else
                                <td>{{$type->name}}</td>
                            </tr>
                        @endif
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop