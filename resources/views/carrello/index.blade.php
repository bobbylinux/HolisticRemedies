@extends('layouts.basic')
@section('content')
<div class="row">
	<table class="table table-bordered table-striped">
		<thead>
			<th class="col-xs-4">{!! Lang::choice('messages.carrello_prodotto',0) !!}</th>
			<th class="col-xs-2">{!! Lang::choice('messages.carrello_costo',0) !!}</th>
			<th class="col-xs-2">{!! Lang::choice('messages.carrello_quantita',0) !!}</th>
			<th class="col-xs-2">{!! Lang::choice('messages.carrello_totale',0) !!}</th>
			<th class="col-xs-2">{!! Lang::choice('messages.carrello_totale',0) !!}</th>
		</thead>
		<tbody>
		@foreach($carrello as $item)
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@show