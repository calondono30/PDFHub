@extends('adminlte::page')

@section('title','Perfiles')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-8">
        <br>
            <div class="card"  style="box-shadow: 12px 12px 12px 10px rgba(20, 20, 20, 0.3);width:60%;margin-left:15%;">
                <div class="card-header text-white bg-dark mb-3">{{ __('Actualizar perfil') }}</div>
 
  <div class="card-body">


          <form id="needs-validation" >
      <div class="form-group">
      <label>Nombres</label>
      <input class="form-control input-lg" placeholder="Nombres" type="text"  id = "nombres" required>
      </div>
      <div class="form-group">
      <label>Apellidos</label>
      <input class="form-control input-lg" placeholder="Apellidos" type="text" id = "apellidos" required>
      </div>

      <div class="form-group">
      <label>Email</label>
      <input class="form-control input-lg" placeholder="Email" type="email"  id = "email" required>
      </div>

      <div class="form-group">
      <label>Telefono</label>
      <input class="form-control input-lg" placeholder="Telefono" type="number"  id = "telefono" required>
      </div><br>

        <button type="submit" class="btn btn-primary" style = "margin-left:26%;">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>

      </form>

        </div>
</div>

</div>
</div>
</div>
@stop




