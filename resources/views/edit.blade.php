@extends('layouts.app')
@section('pageTitle')Editar @endsection

@section('content')

@livewire('edit')

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#phone').mask('(000) 000-0000');
    })
</script>
@endsection