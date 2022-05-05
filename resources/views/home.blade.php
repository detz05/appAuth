@extends('layouts.app')
@section('pageTitle')Inicio @endsection

@section('content')

<h4 class="card-title text-center">Bienvenido ¡{{ auth()->user()->name . ' ' . auth()->user()->lstname }}!</h4>

<div class="text-center mt-4">
    <h5>Proceso finalizado</h5>
</div>

@endsection