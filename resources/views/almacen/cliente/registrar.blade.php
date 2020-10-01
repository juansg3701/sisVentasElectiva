
@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                  <h4 class="card-title">Registrar cliente</h4>
                  <p class="card-category">Registrese</p>
                </div>
                <div class="card-body">
                		{!!Form::open(array('url'=>'almacen/cliente','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>
		<div class="form-group">
			Nombre<input type="text" class="form-control" name="nombre">
			Dirección<input type="text" class="form-control" name="direccion">
			Correo<input type="email" class="form-control" name="correo">
			Teléfono<input type="text" class="form-control" name="telefono">
			<div>
				

				Cédula:
				<input id='id_cedula' type="number" class="form-control"  name="documento" >
				
				
				</div>
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