@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{{ Lang::choice('messages.dash_ordini_index_titolo',0) }}</h2>
    </div>
    {!!Form::open(array('url'=>'admin/ordini/search','method'=>'post'))!!}
    <div class="row">
        <div class="col-xs-2">
            <select class="form-control" name="field" id="field-filter">
                <option value="ordine">{{ strtolower(Lang::choice('messages.dash_ordini_index_numero_ordine',0)) }}</option>
                <option value="id">{{ strtolower(Lang::choice('messages.dash_ordini_index_id',0)) }}</option>
                <option value="cliente">{{ strtolower(Lang::choice('messages.dash_ordini_index_cliente',0)) }}</option>
                <!--<option value="stato">{{ strtolower(Lang::choice('messages.dash_ordini_index_stato',0)) }}</option>-->
            </select>
        </div>
        <div class="col-xs-2">
            <select class="form-control" name="operator">
                <option value="=">{{ Lang::choice('messages.search_equals',0) }}</option>
                <option value="like">{{ Lang::choice('messages.search_contain',0) }}</option>
            </select>
        </div>
        <div class="col-xs-4 search-filter">
            <div class="input-group">
                <input type="text" class="form-control"
                       placeholder="{!! Lang::choice('messages.pulsante_ricerca',0) !!}" name="value">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </span>
            </div>
        </div>
        <div class="col-xs-4 order-status-filter" style="display: none;">
            <div class="input-group">
                <select class="form-control" name="order-status-value">
                    @foreach($stati as $stato)
                        <option value="{{$stato->id}}">{{ $stato->descrizione }}</option>
                    @endforeach
                </select>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </span>
            </div>
        </div>
        <div class="col-xs-1">
            <a href="{!! url('admin/ordini') !!}" class="btn btn-primary">Reset</a>
        </div>
    </div>
    {!! Form::close() !!}
    
    <div class="row">
        <div class="col-md-8">
            {!! $ordini->render() !!}
        </div>
    </div>

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> <a href="{{url('admin')}}">Pannello di controllo</a>
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
            <th class="col-lg-1">{{ Lang::choice('messages.dash_ordini_index_id',0) }}</th>
            <th class="col-lg-2">{{ Lang::choice('messages.dash_ordini_index_cliente',0) }}</th>
            <th class="col-lg-3">{{ Lang::choice('messages.dash_ordini_index_stato',0) }}</th>
            <th class="col-lg-1">{{ Lang::choice('messages.dash_ordini_index_azioni_nome',0) }}</th>
        </tr>
        <thead>
        <tbody>
        @foreach($ordini as $ordine)
            <tr>
                <td class="col-lg-1">{{@$ordine->id}}</td>
                <td class="col-lg-2">{{@date('d/m/Y H:m:s', strtotime($ordine->data_creazione))}}</td>
                <td class="col-lg-1">{{@number_format($ordine->costo - $ordine->sconto + $ordine->costospedizione,2) }}
                    €
                </td>
                <td class="col-lg-1">{{$ordine->utenti->id }}</td>
                <td class="col-lg-2">{{$ordine->utenti->username }}</td>
                <?php $idx = 0; ?>
                <td class="col-lg-3">
                    @foreach($ordine->stati as $stato)
                        <?php $idx++; ?>
                        @if ($idx == count($ordine->stati))
                            {{$stato->descrizione . ' in data ' . date('d/m/Y H:m:s', strtotime($stato->pivot->data_creazione)) }}
                        @endif
                    @endforeach
                </td>
                <td class="col-lg-1">
                    <a href="{{ url('/admin/ordini/'.$ordine['id'].'/edit') }}" data-token="<?= csrf_token() ?>"
                       class='btn-edit-order'>
                        <button type="button" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-pencil"></span> {{Lang::choice('messages.pulsante_modifica',0)}}
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@stop
