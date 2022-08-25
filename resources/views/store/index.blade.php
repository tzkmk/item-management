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
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                        <tr>
                            <td>name</td>
                            <td>name</td>
                            <td>name</td>
                        </tr>
                    @foreach($makers as $maker)
                        <tr>
                            <td>{{$maker}}</td>
                            <td>{{$maker}}</td>
                            <td>{{$maker}}</td>
                        </tr>
                    @endforeach
                </thead>
            </table>
            <div>
                <form action="{{ route('maker-add') }}" method="post">
                    @csrf 
                    <input name="maker" type="text" placeholder="メーカー名を入力">
                    <button type="submit">追加</button>
                </form>
            </div>
        </div>
    
        <!-- 種別一覧 -->
        <div class="row justify-content-center">
            <p>種別一覧</p>
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                        <tr>
                            <td>name</td>
                            <td>name</td>
                            <td>name</td>
                        </tr>
                    @foreach($types as $type)
                        <tr>
                            <td>{{$type}}</td>
                            <td>{{$type}}</td>
                            <td>{{$type}}</td>
                        </tr>
                    @endforeach
                </thead>
            </table>
            <div>
                <form action="{{ route('type-add') }}" method="post">
                    @csrf 
                    <input name="type" type="text" placeholder="種別を入力">
                    <button type="submit">追加</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop