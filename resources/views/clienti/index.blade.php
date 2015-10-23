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
    <div class="col-md-8 col-md-offset-2">
        {!! $clienti->render() !!}
    </div>
</div>

<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th class="col-lg-2 col-md-2">{{ Lang::choice('messages.dash_clienti_index_cognome',0) }}</th>
                    <th class="col-lg-2 col-md-2">{{ Lang::choice('messages.dash_clienti_index_nome',0) }}</th>
                    <th class="col-lg-2 col-md-2">{{ Lang::choice('messages.dash_clienti_index_societa',0) }}</th>
                    <th class="col-lg-2 col-md-4">{{ Lang::choice('messages.dash_clienti_index_attivo',0) }}</th>
                    <th class="col-lg-2 col-md-4">{{ Lang::choice('messages.dash_clienti_index_ruolo',0) }}</th>
                    <th class="col-lg-1 col-md-4">{{ Lang::choice('messages.dash_clienti_index_azioni_nome',0) }}</th>

                </tr>
            <thead>
            <tbody>
                @foreach ($clienti as $cliente)
                <tr>
                    <td>{{@$cliente->cognome}}</td>
                    <td>{{@$cliente->nome}}</td>
                    <td>{{@$cliente->societa}}</td>
                    <td>{{@$cliente->confermato}}</td>
                    <td>{{@$cliente->utenti->ruoli->ruolo}}</td>
                    <td>
                        <a href="{{ url('/admin/clienti/'.$cliente['id'].'/edit') }}"><button type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
                        <a href="{{ url('/admin/clienti/'.$cliente['id']) }}" class="btn-elimina" data-token="<?= csrf_token() ?>"><button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
