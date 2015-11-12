@extends('layouts.back')
@section('content')
<div class="page-header">
    <h2>{{ Lang::choice('messages.dash_ordini_index_titolo',0) }}</h2>
</div>
<!--<div class="row">
    <div class="col-xs-2">
        <select class="form-control units">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select>
    </div>
    <div class="col-xs-2">
        <select class="form-control units">
            <option>username</option>
            <option></option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select>
    </div>
    <div class="col-xs-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="{!! Lang::choice('messages.pulsante_ricerca',0) !!}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> </button>
            </span>
        </div>
    </div>
</div>-->
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
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_ordini_index_numero_ordine',0) }}</th>
            <th class="col-lg-2">{{ Lang::choice('messages.dash_ordini_index_data_ordine',0) }}</th>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_ordini_index_costo_ordine',0) }}</th>
            <th class="col-lg-4">{{ Lang::choice('messages.dash_ordini_index_cliente',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_ordini_index_stato',0) }}</th>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_ordini_index_azioni_nome',0) }}</th>
        </tr>
    <thead>
    <tbody>
        @foreach($ordini as $ordine)
        <tr>
            <td class="col-lg-1">{{@$ordine->id}}</td>
            <td class="col-lg-1">{{@date('d/m/Y H:m:s', strtotime($ordine->data_creazione))}}</td>
            <td class="col-lg-1">{{@number_format($ordine->costo - $ordine->sconto + $ordine->costospedizione,2) }} €</td>
            <td class="col-lg-1"><?php echo $ordine->utenti->clienti->cognome . ' ' . $ordine->utenti->clienti->nome . ' - ' . $ordine->utenti->username ?></td>
            <?php $idx = 0; ?>
            <td class="col-lg-1">
                @foreach($ordine->stati as $stato)
                <?php $idx++; ?>
                @if ($idx == count($ordine->stati))
                {{$stato->descrizione . ' in data ' . date('d/m/Y H:m:s', strtotime($stato->pivot->data_creazione)) }}
                @endif
                @endforeach
            </td>
            <td class="col-lg-1">
                <a href="{{ url('/admin/ordini/'.$ordine['id'].'/edit') }}" data-token ="<?= csrf_token() ?>" class='btn-edit-order'><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> {{Lang::choice('messages.pulsante_modifica',0)}}</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@stop
