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
<div class="row">
    <div class="col-md-6 ">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="{!! Lang::choice('messages.pulsante_ricerca',0) !!}">
            <span class="input-group-btn">                
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> </button>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        {!! $clienti->render() !!}
    </div>
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th class="col-lg-2 col-md-2 hidden-sm hidden-xs">{{ Lang::choice('messages.dash_clienti_index_cognome',0) }}</th>
                    <th class="col-lg-2 col-md-2 hidden-sm hidden-xs">{{ Lang::choice('messages.dash_clienti_index_nome',0) }}</th>
                    <th class="col-lg-2 col-md-2">{{ Lang::choice('messages.dash_clienti_index_username',0) }}</th>
                    <th class="col-lg-2 col-md-4">{{ Lang::choice('messages.dash_clienti_index_attivo',0) }}</th>
                    <th class="col-lg-2 col-md-4">{{ Lang::choice('messages.dash_clienti_index_ruolo',0) }}</th>
                    <th class="col-lg-1 col-md-4">{{ Lang::choice('messages.dash_clienti_index_azioni_nome',0) }}</th>
                </tr>
            <thead>
            <tbody>
                @foreach ($clienti as $cliente)
                <tr>
                    <td class="col-lg-2 col-md-2 hidden-sm hidden-xs">{{@$cliente->cognome}}</td>
                    <td class="col-lg-2 col-md-2 hidden-sm hidden-xs">{{@$cliente->nome}}</td>
                    <td>{{@$cliente->utenti->username}}</td>
                    @if ($cliente->utenti->confermato == 1)
                    <td>{!! Lang::choice('messages.si',0) !!}</td>
                    @else
                    <td>{!! Lang::choice('messages.no',0) !!}</td>
                    @endif
                    @if ($cliente->utenti->ruoli->id == 1)
                    <td>{!! Lang::choice('messages.si',0) !!}</td>
                    @else
                    <td>{!! Lang::choice('messages.no',0) !!}</td>
                    @endif
                    <td>
                        <a href="{{ url('/admin/clienti/'.$cliente['id'].'/edit') }}"><button type="button" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifica</button> </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
