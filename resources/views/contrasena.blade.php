@extends('adminlte::page')


@section('title','Dashboard')


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
                <div class="card-header text-white bg-dark mb-3">{{ __('Cambio de contraseña') }}</div>
 
  <div class="card-body">


          <form id="needs-validation" >
      <div class="form-group">
      <label>Contraseña actual</label>
      <input class="form-control input-lg" placeholder="Contraseña actual" type="password"  id = "oldpw" required>
      </div>
      <div class="form-group">
      <label>Nueva contraseña</label>
      <input class="form-control input-lg" placeholder="Nueva contraseña" type="password" id = "newpw" required>
      </div>

      <div class="form-group">
      <label>Confirmar contraseña</label>
      <input class="form-control input-lg" placeholder="Confirmar contraseña" type="password"  id = "confirmpw" required>
      </div><br>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>

      </form>
          
        </div>
</div>

</div>
</div>
</div>
@stop


