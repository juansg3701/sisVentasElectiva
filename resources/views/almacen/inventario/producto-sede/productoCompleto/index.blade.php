@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Producto completos</h4>
                  <p class="card-category">Lista de Productos Completos</p>
                </div>
                <div class="card-body">
            <div id=formulario>
		<div class="form-group">
		
			@include('almacen.inventario.producto-sede.productoCompleto.search')
		<br>


			<br>
			<div align="center">
			<a href="{{URL::action('ProductoSedeController@create',0)}}"><button class="btn btn-info">Registrar producto</button></a>
			<a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Volver</a>
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
                  <h4 class="card-title ">Productos</h4>
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
							<th>CATEGORÍA</th>
							<th>UNIDAD MEDIDA</th>
							<th>PRECIO</th>
							<th>STOCK MÍNIMO</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($productos as $ps)
						<tr>
							<td>{{ $ps->id_producto}}</td>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->categoria_id_categoria}}</td>
							<td>{{ $ps->unidad_de_medida}}</td>
							<td>{{ $ps->precio}}</td>
							<td>{{ $ps->stock_minimo}}</td>
							<td>
								<a href="{{URL::action('ProductoSedeController@edit',$ps->id_producto)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.inventario.producto-sede.productoCompleto.modal')
						@endforeach
					</table>
				</div>
				{{$productos->render()}}
			</div>
		</div>
	</div>
			</div><br>
@stop