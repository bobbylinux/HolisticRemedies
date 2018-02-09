@extends('layouts.back')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.dash_sconti_totale_index_titolo',0) }}</h2><a href="{{ url('/admin/sconti/totale/create') }}"
                                                                                  class="btn btn-success">{{ Lang::choice('messages.dash_sconti_totale_index_pulsante_nuovo',0) }}</a>
</div>
<div class="col-md-8 col-md-offset-2">
    <div class="col-md-8 col-md-offset-2">
        {{ $scontitotaleordine->render() }}
    </div>
</div>
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
    </li>
    <li class="active">
        <i class="fa fa-money"></i> Sconti
    </li>
    <li class="active">
        Totale ordine
    </li>
</ol>
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_sconti_totale_index_quantita_minima',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_sconti_totale_index_quantita_massima',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_sconti_totale_index_sconto',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_prodotti_index_azioni_nome',0) }}</th>
        </tr>
    <thead>
    <tbody>
        @foreach($scontitotaleordine as $scontototaleordine)
        <tr>
            <td class="col-lg-3">{{@$scontototaleordine['totale_min']}}</td>
            <td class="col-lg-3">{{@$scontototaleordine['totale_max']}}</td>
            <td class="col-lg-3">{{@$scontototaleordine['sconto']}}</td>
            <td class="col-lg-3">
                <a href="{{ url('/admin/sconti/totale/'.$scontototaleordine['id'].'/edit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>{{ Lang::choice('messages.pulsante_modifica',0) }}</a>
                <a href="{{ url('/admin/sconti/totale/'.$scontototaleordine['id']) }}" class="btn btn-danger btn-cancella"
                   data-token="<?= csrf_token() ?>"><span class="glyphicon glyphicon-trash"></span>{{ Lang::choice('messages.pulsante_elimina',0) }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
