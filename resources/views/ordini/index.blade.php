@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{{ Lang::choice('messages.dash_ordini_index_titolo',0) }}</h2>
    </div>
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
                {!! $ordini->render() !!}
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
                        <?php $idx=0; ?>
                        @foreach($ordine->stati as $stato)
                            <?php $idx++;?>
                            @if ($idx == count($ordine->stati))
                            <td>{{$stato->descrizione . ' in data ' . date('d/m/Y H:m:s', strtotime($stato->pivot->data_creazione)) }}</td>
                            @endif
                        @endforeach
                        <td>
                            <a href="{{ url('/admin/ordini/'.$ordine['id'].'/edit') }}" data-token ="<?= csrf_token() ?>" class='btn-edit-order'><button type="button" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"></span> {{Lang::choice('messages.pulsante_modifica',0)}}</button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@stop
