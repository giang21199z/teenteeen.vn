@extends('master')
@section('content')
    @for($i = 0; $i<10; $i++)
        so thu tu: {{$i}}
    @endfor
    <?php $dem = 0;
    $arr = ["1", "2", "g"]
    ?>
    @while($dem<10)
        {{$dem++}}
    @endwhile
    @foreach($arr as $value)
        {{$value}}
    @endforeach
@stop