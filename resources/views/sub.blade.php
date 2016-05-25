@extends('master')
@section('content')
    sub
@stop
@section('slide')
    sub
    @parent
@stop
<?php
$name = "giangnd";?>
{{$name}}
{!!$name!!}
<?php
$type = 2;
?>
@if($type == 1)
    type 1
@else
    type 2
@endif
{{ isset($lkd)?$lkd:"khong ton tai" }}
{{ $diem or 'khong ton tai diem' }}