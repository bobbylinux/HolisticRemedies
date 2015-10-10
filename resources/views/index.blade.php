@extends('layouts.front')
@section('tips')
    <div class="row">
        <div class="col-lg-12">
            <h1>TIPS Section</h1>
        </div>
    </div>
@stop
@section('ingredients')
    <div class="row">
        <div class="col-lg-12">
            <h2>{!!Lang::choice('messages.ingredienti_titolo',0)!!}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>{!!Lang::choice('messages.ingredienti_paragrafo_1',0)!!}</p>

            <p>{!!Lang::choice('messages.ingredienti_paragrafo_2',0)!!}</p>

            <p></p>
        </div>
    </div>
@stop
@section('buy')
    <div class="row">
        <div class="col-lg-12">
            <h1>Contact Section</h1>
        </div>
    </div>
@stop