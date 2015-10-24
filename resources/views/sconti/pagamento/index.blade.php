@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{{ Lang::choice('messages.dash_sconti_pagamento_index_titolo',0) }}</h2><a href="{{ url('/admin/sconti/pagamento/create') }}"
                                                                               class="btn btn-success">{{ Lang::choice('messages.dash_sconti_pagamento_index_pulsante_nuovo',0) }}</a>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-8 col-md-offset-2">
            {{ $scontipagamento->render() }}
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
             Tipo di pagamento
        </li>
    </ol>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.dash_sconti_pagamento_create_tipo_pagamento',0) }}</th>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.dash_sconti_pagamento_index_sconto',0) }}</th>
                    <th class="col-lg-3 col-md-4">{{ Lang::choice('messages.dash_prodotti_index_azioni_nome',0) }}</th>
                </tr>
                <thead>
                <tbody>
                @foreach($scontipagamento as $scontopagamento)
                    <tr>
                        <td>{{$scontopagamento->tipiPagamento->pagamento}}</td>
                        <td>{{$scontopagamento->sconto}}</td>
                        <td>
                            <a href="{{ url('/admin/sconti/pagamento/'.$scontopagamento['id'].'/edit') }}" class="btn btn-primary">{{ Lang::choice('messages.pulsante_modifica',0) }}</a>
                            <a href="{{ url('/admin/sconti/pagamento/'.$scontopagamento['id']) }}" class="btn btn-danger btn-cancella"
                               data-token="<?= csrf_token() ?>">{{ Lang::choice('messages.pulsante_elimina',0) }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
