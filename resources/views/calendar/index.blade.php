@extends('adminlte::page')

@section('title', '発売日カレンダー')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>発売日カレンダー</h1>
        <input type="submit" class="btn btn-sm btn-outline-secondary" value="このページを印刷する" onclick="window.print();">
    </div>  
@stop

@section('content')
    <div class="card text-center">
        <form action="{{ route('calendar') }}" method="get" id="calendar-form" class="m-3">
            <input type="month" class="form-control w-25 m-auto" name="month" onchange="inputChange()" value="{{ $month }}">
            <input type="submit" id="submit" class="d-none" >
        </form>

        <!-- カレンダー表示 -->
        <div class="calendar-table m-1">
            <table class="table table-bordered table-striped" style="table-layout:fixed;">
                <thead>
                    <tr>
                        <th class="text-danger table-secondary">日</th>
                        <th class="table-secondary">月</th>
                        <th class="table-secondary">火</th>
                        <th class="table-secondary">水</th>
                        <th class="table-secondary">木</th>
                        <th class="table-secondary">金</th>
                        <th class="table-secondary">土</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($weeks))
                        @foreach($weeks as $week)
                            <!-- 日付欄 -->
                            <tr >
                                @foreach($week as $day)
                                    @if($day === $week[0])
                                        <td class="text-danger">{{ $day }}</td>
                                    @else
                                        <td>{{ $day }}</td>
                                    @endif
                                @endforeach
                            </tr>
                            <!-- メモ欄 -->
                            <tr>
                                @foreach($week as $day)
                                    <td data-id="{{ $day }}" class="calendar-task">
                                        <div class="list-group">
                                            @foreach($items as $item)                                            
                                                @if(isset($item) && $day == date('j', strtotime($item->release_at)))
                                                    <button type="button" class="p-2 list-group-item list-group-item-action list-group-item-success modal_open"  data-bs-toggle="modal" data-bs-target="#js-modal-{{ $item->id }}">{{ $item->name }}</button>
                                                @endif
                                                <!-- モーダル表示内容 -->
                                                <div class="modal fade" id="js-modal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content m-auto text-left">
                                                            <div class="modal-header d-flex justify-content-between">
                                                                <h3 class="modal-title">商品詳細</h5>
                                                                @if($user->admin_id === 1)
                                                                    <form method="get" action="{{ route('edit', ['id' => $item->id])}}">
                                                                        <div class="text-center">
                                                                            <button type="submit" class="btn btn-outline-success">編集</button>
                                                                        </div>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">商品名</label>
                                                                    <input type="text" class="form-control" id="name"  value="{{ $item->name }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="maker">メーカー</label>
                                                                    <input type="text" class="form-control" id="maker" value="{{ $item->maker_name }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="type">種別</label>
                                                                    <input type="text" class="form-control" id="type" value="{{ $item->type_name }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="detail">詳細</label>
                                                                    <textarea class="form-control" id="detail" cols="30" rows="5"  readonly>{{ $item->detail }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="release_at">発売日</label>
                                                                    <input type="date" class="form-control" id="release_at" name="release_at"  value="{{ $item->release_at }}" readonly>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-dismiss="modal">閉じる</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                       
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script>
    /**
    * カレンダー選択月自動送信
    */
    function inputChange(){
        document.getElementById("submit").click();
    }
</script>
@stop