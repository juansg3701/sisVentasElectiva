@extends ('layouts.admin')
@section ('contenido')
	
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>


<body>
	<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Clientes</h4>
                </div>
                <div class="card-body">
                	<div id=formulario>
		<div class="form-group">
			@include('almacen.cliente.search')
		
			<div align="center">
				

			<a href="{{URL::action('ClienteController@create',0)}}"><button class="btn btn-primary">Registrar Cliente</button></a>
			<a href="{{url('almacen/facturacion/listaVentas')}}" class="btn btn-warning">Ventas</a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
                </div>
               </div>
             </div>
            </div>
          </div>
         </div>

	
<div class="row">
	<div class="card">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card-header card-header-primary">
                  <h4 class="card-title ">Clientes</h4>
                  <p class="card-category"> Clientes registrados</p>
                </div>

                <div class="card-body">
				<div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
							<th>Id</th>
							<th>Nombre</th>
							<th>Dirección</th>
							<th>Correo</th>
							<th>Teléfono</th>
							<th>No. Documento</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($clientes as $cli)
						<tr>
							<td>{{ $cli->id_cliente}}</td>
							<td>{{ $cli->nombre}}</td>
							<td>{{ $cli->direccion}}</td>
							<td>{{ $cli->correo}}</td>
							<td>{{ $cli->telefono}}</td>
							<td>{{ $cli->documento}}</td>
							
							<td>
								<a href="{{URL::action('ClienteController@edit',$cli->id_cliente)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.cliente.modal')
						@endforeach
					</table>
				</div>
			</div>
				{{$clientes->render()}}
			</div>
		</div>
			</div><br>


@stop