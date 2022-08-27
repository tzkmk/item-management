@extends('adminlte::page')

@section('title', 'カレンダー')

@section('content_header')
    <h1>カレンダー</h1>
    <input type="submit" value="このページを印刷する" onclick="window.print();">
@stop

@section('content')
    <div class="main-calendar text-center">
        <form action="{{ route('calendar') }}" method="get" id="calendar-form" class="mb-2">
            <input type="month" name="month" onchange="inputChange()" value="{{ $month }}">
            <input type="submit" id="submit" class="d-none" >
        </form>

        <!-- カレンダー表示 -->
        <div class="calendar-table">
            <table class="table table-bordered">
                <tr>
                    <th class="text-danger">日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
                @if(isset($weeks))
                    @foreach($weeks as $week)
                        <!-- 日付欄 -->
                        <tr>
                            @foreach($week as $day)
                                @if($day === $week[0])
                                    <td class="text-danger calendar-day"><?php echo $day; ?></td>
                                @else
                                    <td class="calendar-day"><?php echo $day; ?></td>
                                @endif
                            @endforeach
                        </tr>
                        <!-- メモ欄 -->
                        <tr>
                            @foreach($week as $day)
                                <td data-id="<?php echo $day; ?>" class="calendar-task">
                                    <ul>
                                        @foreach($items as $item)
                                            <a data-bs-toggle="modal" data-bs-target="#js-modal-{{ $item->id }}">
                                                    <?php $item_day = date('j', strtotime($item->release_at));
                                                        ${'item_'.$item->id} = $item;
                                                        if(isset($item) && $day == $item_day){
                                                            echo "<li>".htmlspecialchars($item->name)."</li>"; 
                                                        }
                                                    ;?>
                                            </a>
                                        @endforeach
                                    </ul>
                                    
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
<script>
    /**
    * カレンダー選択月自動送信
    */
    function inputChange(){
        document.getElementById("submit").click();
    }
</script>
@endsection