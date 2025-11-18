@extends('adminlte::page')

@section('title','Repositorio')

@section('content_header')

@stop


@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-12">
        <br>
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Listado de documentos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            @csrf
            <table class="table table-success table-striped">
                        <tr>
                            <td><strong>Id</strong></td>
                            <td><strong>Archivo</strong></td>
                            <td><strong>Acciones</strong></td>
                            <td><strong>Fecha Registro</strong></td>
                        </tr>

                        @foreach($result as $d)
                        <tr>
                            <td>{{ $d['id'] }}</td>
                            <td>{{ $d['archivo'] }}</td>
                            <td>
                                {{ method_field('GET') }}
                                {{  csrf_field() }}
                                <a href="{{ $d['ruta_pdf'] }}" target="_blank">
                                    <button type="button" class="btn btn-success btn-primary" title="Visualizar"><span class="fa fa-eye"></span></button>
                                </a>
                            </td>

                            <td>{{ $d['updated_at'] }}</td>
                        </tr>
                        @endforeach
                    </table>
                         
            </div>
        </div>

    </div>
</div>
@endsection
