@extends('layouts.basic')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.ordini_utente_titolo',0) }}</h2>
    <p>{!! Lang::choice('messages.ordini_utente_segui_il_tuo_ordine',0) !!}</p>
</div>
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-home"></i>  <a href="{{url('/')}}">Home Page</a>
    </li>
    <li class="active">
        <i class="fa fa-money"></i> {!! Lang::choice('messages.ordini',0) !!}
    </li>
</ol>
<div class="row">
    <div class="col-lg-8">
        {!! $ordini->render() !!}
    </div>
</div>

<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-lg-1 col-md-2">{{ Lang::choice('messages.ordini_utente_numero_ordine',0) }}</th>
                    <th class="col-lg-2 col-md-2">{{ Lang::choice('messages.ordini_utente_data',0) }}</th>
                    <th class="col-lg-1 col-md-2">{{ Lang::choice('messages.ordini_utente_costo',0) }}</th>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.ordini_utente_stato',0) }}</th>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.ordini_utente_vettura',0) }}</th>
                    <th class="col-lg-3 col-md-2"></th>


                </tr>
            <thead>
            <tbody>
                @foreach($ordini as $ordine)
                <tr>
                    <td>{{@$ordine->id}}</td>
                    <td>{{@date('d/m/Y H:i:s', strtotime($ordine->data_creazione))}}</td>
                    <?php $scontoPagamento = ($ordine->pagamenti->scontiTipoPagamento->sconto / 100) * ($ordine->costo - $ordine->sconto); ?>
                    <td>{{@number_format($ordine->costo - $ordine->sconto + $ordine->costospedizione-$scontoPagamento,2) }}</td>
                    <?php $idx = 0; ?>
                    <td>
                        @foreach($ordine->stati as $stato)
                        <?php $idx++; ?>
                        @if ($idx == count($ordine->stati))
                        {{$stato->descrizione . ' in data ' . date('d/m/Y H:i:s', strtotime($stato->pivot->data_creazione)) }}
                        @endif
                        @endforeach
                    </td>
                    <td>{{@$ordine->tracking->vettura}}</td>
                    <td>
                        <a href="{{ url('/admin/ordini/'.$ordine['id']) }}" data-token ="<?= csrf_token() ?>" class='btn-edit-order'><button type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-folder-open"></span> {{Lang::choice('messages.pulsante_visualizza',0)}}</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop