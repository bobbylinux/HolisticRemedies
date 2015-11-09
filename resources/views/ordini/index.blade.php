@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{{ Lang::choice('messages.dash_ordini_index_titolo',0) }}</h2>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-8 col-md-offset-2">
                {!! $ordini->render() !!}
            </div>
        </div>
    </div>

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
        </li>
        <li class="active">
            <i class="fa fa-money"></i> Ordini
        </li>
    </ol>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="col-lg-1 col-md-2">{{ Lang::choice('messages.dash_ordini_index_numero_ordine',0) }}</th>
                    <th class="col-lg-2 col-md-2">{{ Lang::choice('messages.dash_ordini_index_data_ordine',0) }}</th>
                    <th class="col-lg-1 col-md-2">{{ Lang::choice('messages.dash_ordini_index_costo_ordine',0) }}</th>
                    <th class="col-lg-4 col-md-2">{{ Lang::choice('messages.dash_ordini_index_cliente',0) }}</th>
                    <th class="col-lg-3 col-md-2">{{ Lang::choice('messages.dash_ordini_index_stato',0) }}</th>
                    <th class="col-lg-1 col-md-2">{{ Lang::choice('messages.dash_ordini_index_azioni_nome',0) }}</th>
                </tr>
                <thead>
                <tbody>
                @foreach($ordini as $ordine)
                    <tr>
                        <td>{{@$ordine->id}}</td>
                        <td>{{@date('d/m/Y H:m:s', strtotime($ordine->data_creazione))}}</td>
                        <td>{{@number_format($ordine->costo - $ordine->sconto + $ordine->costospedizione,2) }} €</td>
                        <td><?php echo $ordine->utenti->clienti->cognome . ' ' . $ordine->utenti->clienti->nome . ' - ' .$ordine->utenti->username?></td>
                        @foreach($ordine->stati as $stato)
                        <td>{{@$stato->descrizione . ' in data ' . date('d/m/Y H:m:s', strtotime($stato->pivot->data_creazione)) }}</td>
                        @endforeach
                        <td>
                            <a href="{{ url('/admin/clienti/'.$ordine['id'].'/edit') }}"><button type="button" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
