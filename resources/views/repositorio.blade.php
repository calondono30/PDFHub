@extends('adminlte::page')

@section('title','Repositorio')

@section('content_header')

<!-- Styles -->

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop


@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-12" style="padding: 0px 25px 0px 25px;">
        <br>
            <div class="card"  style="box-shadow: 7px 7px 12px 0 rgba(20, 20, 20, 0.3);">
                <div class="card-header text-white bg-dark mb-3">{{ __('Listado de documentos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
            <form action="registrar_documento" method="post">
            @csrf
            

            </form>
                         
            </div>
        </div>

    </div>
</div>
@endsection
