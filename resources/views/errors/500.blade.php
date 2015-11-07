@extends('layouts.basic')
@section('content')
    <div class="col-md-6 col-md-offset-3 col-xs-8">
        <div class="panel panel-danger">
            <div class="panel-heading">{!! Lang::choice('messages.500title',0)!!}</div>
            <div class="panel-body">
                <div class="title">{!! Lang::choice('messages.500body',0) !!}</div>
            </div>
        </div>
    </div>
@stop
