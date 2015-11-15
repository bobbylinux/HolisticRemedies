@extends('layouts.back')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.dash_clienti_index_titolo',0) }}</h2>
</div>
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
    </li>
    <li class="active">
        <i class="fa fa-user"></i> Clienti
    </li>
</ol>
{!!Form::open(array('url'=>'admin/clienti/search','method'=>'post'))!!}
<div class="row">
    <div class="col-xs-2">
        <select class="form-control" name="field">
            <option value="id">{{ strtolower(Lang::choice('messages.dash_clienti_index_id',0)) }}</option>
            <option value="cognome">{{ strtolower(Lang::choice('messages.dash_clienti_index_cognome',0)) }}</option>
            <option value="nome">{{ strtolower(Lang::choice('messages.dash_clienti_index_nome',0)) }}</option>
            <option value="username">{{ strtolower(Lang::choice('messages.dash_clienti_index_username',0)) }}</option>
            <option value="attivo">{{ strtolower(Lang::choice('messages.dash_clienti_index_attivo',0)) }}</option>
        </select>
    </div>
    <div class="col-xs-1">
        <select class="form-control" name="operator">
            <option value="=">{{ Lang::choice('messages.search_equals',0) }}</option>
            <option value="like">{{ Lang::choice('messages.search_contain',0) }}</option>
        </select>
    </div>

    <div class="col-xs-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="{!! Lang::choice('messages.pulsante_ricerca',0) !!}" name="value">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> </button>
            </span>
        </div>
    </div>
    <div class="col-xs-1">
        <a href="{!! url('admin/clienti') !!}" class="btn btn-primary">Reset</a>
    </div>
</div>
{!! Form::close() !!}
<div class="row">
    <div class="col-md-8">
        {!! $clienti->render() !!}
    </div>
</div>
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_clienti_index_id',0) }}</th>
            <th class="col-lg-2 hidden-sm hidden-xs">{{ Lang::choice('messages.dash_clienti_index_cognome',0) }}</th>
            <th class="col-lg-2 hidden-sm hidden-xs">{{ Lang::choice('messages.dash_clienti_index_nome',0) }}</th>
            <th class="col-lg-2">{{ Lang::choice('messages.dash_clienti_index_username',0) }}</th>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_clienti_index_attivo',0) }}</th>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_clienti_index_azioni_nome',0) }}</th>
        </tr>
    <thead>
    <tbody>
        @foreach ($clienti as $cliente)
        <tr>
            <td class="col-lg-1 col-md-1">{{@$cliente->utenti->id}}</td>
            <td class="col-lg-2 col-md-2 hidden-sm hidden-xs">{{@$cliente->cognome}}</td>
            <td class="col-lg-2 col-md-2 hidden-sm hidden-xs">{{@$cliente->nome}}</td>
            <td class="col-lg-2">{{@$cliente->utenti->username}}</td>
            @if ($cliente->utenti->confermato == 1)
            <td class="col-lg-1 hidden-sm hidden-xs">{!! Lang::choice('messages.si',0) !!}</td>
            @else
            <td class="col-lg-1 hidden-sm hidden-xs">{!! Lang::choice('messages.no',0) !!}</td>
            @endif
            <td class="col-lg-1">
                <a href="{{ url('/admin/clienti/'.$cliente['id'].'/edit') }}"><button type="button" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifica</button> </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
