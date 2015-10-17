@extends('layouts.back')
@section('content')
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{!!$error!!}</p>
    @endforeach
@show