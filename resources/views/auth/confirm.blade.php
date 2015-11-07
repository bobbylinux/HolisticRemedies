@extends('layouts.basic')
@section('content')
    <div class="col-md-6 col-md-offset-3 col-xs-8">
        @if ($errore)
            <div class="panel panel-danger">
                <div class="panel-heading">{!!$titolo!!}</div>
                <div class="panel-body">
                    <p>{!!$conferma!!}</p>
                </div>
            </div>
        @else
            <div class="page-header">
                <h2>{!!$titolo!!}</h2>
            </div>
            <div class="panel panel-success">
                <div class="panel-body">
                    <p>{!!$conferma!!}</p>
                    <a href="{!!url('/')!!}"
                       class="btn btn-primary">{!!Lang::choice('messages.pulsante_home_page',0)!!}</a>
                </div>
            </div>
        @endif
    </div>
@stop
