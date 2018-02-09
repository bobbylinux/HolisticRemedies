@extends('layouts.back')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.dash_sconti_quantita_index_titolo',0) }}</h2><a href="{{ url('/admin/sconti/quantita/create') }}"
                                                                                  class="btn btn-success">{{ Lang::choice('messages.dash_sconti_quantita_index_pulsante_nuovo',0) }}</a>
</div>
<div class="col-md-8 col-md-offset-2">
    <div class="col-md-8 col-md-offset-2">
        {{ $scontiquantita->render() }}
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
        Quantità
    </li>
</ol>
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_sconti_quantita_index_quantita_minima',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_sconti_quantita_index_quantita_massima',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_sconti_quantita_index_sconto',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_prodotti_index_azioni_nome',0) }}</th>
        </tr>
    <thead>
    <tbody>
        @foreach($scontiquantita as $scontoquantita)
        <tr>
            <td class="col-lg-3">{{@$scontoquantita['quantita_min']}}</td>
            <td class="col-lg-3">{{@$scontoquantita['quantita_max']}}</td>
            <td class="col-lg-3">{{@$scontoquantita['sconto']}}</td>
            <td class="col-lg-3">
                <a href="{{ url('/admin/sconti/quantita/'.$scontoquantita['id'].'/edit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>{{ Lang::choice('messages.pulsante_modifica',0) }}</a>
                <a href="{{ url('/admin/sconti/quantita/'.$scontoquantita['id']) }}" class="btn btn-danger btn-cancella"
                   data-token="<?= csrf_token() ?>"><span class="glyphicon glyphicon-trash"></span>{{ Lang::choice('messages.pulsante_elimina',0) }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
