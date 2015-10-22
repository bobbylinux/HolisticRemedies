@extends('layouts.back')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.dash_clienti_index_titolo',0) }}</h2></div>
<div class="col-md-8 col-md-offset-2">
    <div class="col-md-8 col-md-offset-2">
        {{ $clienti->render() }}
    </div>
</div>
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
    </li>
    <li class="active">
        <i class="fa fa-user"></i> Clienti
    </li>

</ol>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.dash_clienti_index_cognome',0) }}</th>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.dash_clienti_index_nome',0) }}</th>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.dash_clienti_index_societa',0) }}</th>
                    <th class="col-lg-3 col-md-4">{{ Lang::choice('messages.dash_clienti_index_username',0) }}</th>
                    <th class="col-lg-3 col-md-4">{{ Lang::choice('messages.dash_clienti_index_attivo',0) }}</th>
                    <th class="col-lg-3 col-md-4">{{ Lang::choice('messages.dash_clienti_index_ruolo',0) }}</th>
                    <th class="col-lg-3 col-md-4">{{ Lang::choice('messages.dash_clienti_index_azioni_nome',0) }}</th>
                    @foreach ($clienti as $cliente)
                <tr>
                    <td>{{@$cliente['cognome']}}</td>
                    <td>{{@$cliente['nome']}}</td>
                    <td>{{@$cliente['societa']}}</td>
                    <td>{{@$cliente->utente['username']}}</td>
                    <td>{{@$cliente['attivo']}}</td>
                    <td>{{@$cliente->utente->ruolo['ruolo']}}</td>
                    <td>
                        <a href="{{ url('/admin/clienti/'.$cliente['id'].'/edit') }}" class="btn btn-primary">{{ Lang::choice('messages.pulsante_modifica',0) }}</a>
                        <a href="{{ url('/admin/clienti/'.$cliente['id']) }}" class="btn btn-danger btn-cancella"
                           data-token="<?= csrf_token() ?>">{{ Lang::choice('messages.pulsante_elimina',0) }}</a>
                    </td>
                </tr>
                @endforeach
                </tr>
            <thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@stop
