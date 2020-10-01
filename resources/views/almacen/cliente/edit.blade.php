@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

	<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Editar cliente</h4>
                  <p class="card-category">Edita la información del cliente</p>
                </div>
                <div class="card-body">
                		{!!Form::model($cliente,['method'=>'PATCH','route'=>['almacen.cliente.update',$cliente->id_cliente]])!!}
    
	 {{Form::token()}}



	<div id=formulario>
		<div class="form-group">
			Nombre<input type="text" class="form-control" name="nombre" value="{{$cliente->nombre}}">
			Dirección<input type="text" class="form-control" name="direccion" value="{{$cliente->direccion}}">
			Correo
			<input type="text" class="form-control" name="correo" value="{{$cliente->correo}}">
			Teléfono<input type="text" class="form-control" name="telefono" value="{{$cliente->telefono}}">
			<div>

				Cédula:
				<input id='id_cedula' type="number" class="form-control"  name="documento" value="{{$cliente->documento}}">
				
			</div>

			<br>
			<div align="center">
			<button class="btn btn-info" type="submit">Registrar Cliente</button>
			<a href="{{url('almacen/cliente')}}" class="btn btn-danger">Volver</a>

		</div>
		</div>
	</div>
{!!Form::close()!!}		
                </div>
               </div>
             </div>
            </div>
          </div>
         </div>



</body>

@stop