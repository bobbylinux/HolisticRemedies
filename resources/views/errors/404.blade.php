@extends('layouts.basic')
@section('content')
    <div class="col-lg-12">
        <div class="panel panel-danger">
            <div class="panel-body">
                <h3 style="text-align: center;">{!! Lang::choice('messages.404title',0) !!} {!! Lang::choice('messages.404body',0) !!}</h3>

            </div>
        </div>
    </div>
@stop
