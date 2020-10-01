@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>


	<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Facturación</h4>
                  <p class="card-category">Lista de ventas</p>
                </div>
                <div class="card-body">
          <div id=formulario>
		<div class="form-group" align="center">
			@include('almacen.facturacion.listaVentas.search')
		
			</div>
	</div>
	<div align="center">
	<a href="{{url('almacen/facturacion/listaVentas')}}"><button class="btn btn-info">Registrar venta</button></a>
	<a href="{{url('almacen/facturacion/listaVentas')}}" class="btn btn-danger">Volver</a>
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
                  <h4 class="card-title ">Lista de ventas</h4>
                  <p class="card-category"> Total de ventas</p>
                </div>

                <div class="card-body">
				<div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
							<th>id</th>
							<th>Fecha</th>
							<th>Metodo de pago</th>
							<th>No.Productos</th>
							<th>Cliente</th>
							<th>Pago total</th>
							<th>Pago factura</th>
							<th>Lugar</th>
							<th>Opciones</th>
						</thead>

						@foreach($facturas as $f)
						<tr>
							<td>{{ $f->id_factura}}</td>
							<td>{{ $f->fecha}}</td>
							<td>{{ $f->tipo_pago_id_tpago}}</td>
							<td>{{ $f->noproductos}}</td>
							<td>{{ $f->cliente_id_cliente}}</td>
							<td>{{ $f->pago_total}}</td>

							@if($f->facturaPaga=='0')
							<td>No realizado</td>
							@endif

							@if($f->facturaPaga=='1')
							<td>Realizado</td>
							@endif
							
							
							@if($f->tiendaodomicilio=='0')
							<td>Tienda</td>
							@endif
							@if($f->tiendaodomicilio=='1')
							<td>Domicilio</td>
							@endif
								<td>

								<a href="{{URL::action('facturacionListaVentas@edit',$f->id_factura)}}"><button class="btn btn-info">Productos/Pagos</button></a>
								@if($f->facturaPaga=='0')
								
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@else
								
								<a href="" data-target="#modal-delete-{{$f->id_factura}}" data-toggle="modal"><button class="btn btn-danger" disabled="true">Eliminar</button></a>
								@endif
							</td>
						</tr>
							@include('almacen.facturacion.listaVentas.modal')
							@include('almacen.facturacion.listaVentas.datafono')
						@endforeach
					</table>
				</div>
				
			</div>
			</div><br>
			
@stop