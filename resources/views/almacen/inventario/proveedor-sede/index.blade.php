@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>


<body>

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Inventario</h4>
                  <p class="card-category">Lista inventario</p>
                </div>
                <div class="card-body">
                	<div id=formulario>
		<div class="form-group">
			@include('almacen.inventario.proveedor-sede.search')
			<br>
			<div align="center">
				
			<a href="{{url('almacen/inventario/ean')}}"><button class="btn btn-info">Registrar inventario</button></a>

			<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}"><button class="btn btn-info">Registrar producto</button></a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			<br><br>
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
                  <h4 class="card-title ">Inventario</h4>
                  <p class="card-category"> Productos existentes</p>
                </div>

                <div class="card-body">
				<div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
							<th>ID</th>
							<th>NOMBRE</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>CANTIDAD</th>
							<th>DISPONIBILIDAD</th>
							<th>OPCIONES</th>
						</thead>
					@foreach($productos as $ps)
					
						<tr>
							<td>{{ $ps->id_stock}}</td>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->cantidad}}</td>
							@if($ps->disponibilidad=='1')
							<td>Disponible</td>
							@endif
							@if($ps->disponibilidad=='0')
							<td>No disponible</td>
							@endif

							<td>
								<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ps->id_stock}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@endforeach


					</table>
				</div>
			</div>
		</div>
			</div>
			</div><br>
@stop