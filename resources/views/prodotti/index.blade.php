@extends('layouts.back')
@section('content')
    <div class="page-header">
        <h2>{{ Lang::choice('messages.dash_prodotti_index_titolo',0) }}</h2><a href="{{ url('/admin/prodotti/create') }}"
                                                                               class="btn btn-success">{{ Lang::choice('messages.dash_prodotti_index_pulsante_nuovo',0) }}</a>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-8 col-md-offset-2">
            {{ $prodotti->render() }}
        </div>
    </div>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i>  <a href="{{url('admin')}}">Pannello di controllo</a>
        </li>
        <li class="active">
            <i class="fa fa-th-large"></i> Prodotti
        </li>
    </ol>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="col-lg-9 col-md-8">{{ Lang::choice('messages.dash_prodotti_index_prodotto_nome',0) }}</th>
                    <th class="col-lg-3 col-md-4">{{ Lang::choice('messages.dash_prodotti_index_azioni_nome',0) }}</th>
                </tr>
                <thead>
                <tbody>
                @foreach($prodotti as $prodotto)
                    <tr>
                        <td>{{@$prodotto['prodotto']}}</td>
                        <td>
                            <a href="{{ url('/admin/prodotti/'.$prodotto['id'].'/edit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>{{ Lang::choice('messages.pulsante_modifica',0) }}</a>
                            <a href="{!!url('/admin/prodotti/'.$prodotto['id'])!!}" data-token="{!! csrf_token() !!}" class="btn btn-danger btn-cancella"
                               data-token="<?= csrf_token() ?>"><span class="glyphicon glyphicon-trash"></span>{{ Lang::choice('messages.pulsante_elimina',0) }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
