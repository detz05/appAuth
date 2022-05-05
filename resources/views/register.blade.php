@extends('layouts.app')
@section('pageTitle')Registro @endsection

@section('content')

@livewire('register')

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#phone').mask('(000) 000-0000');
    })
</script>
@endsection