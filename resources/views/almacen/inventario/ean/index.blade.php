@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
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
                  <h4 class="card-title">Inventario</h4>
                  <p class="card-category">Registrar producto</p>
                </div>
                <div class="card-body">
                	{!! Form::open(array('url'=>'almacen/inventario/ean','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
				EAN:
				<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
				
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
					</div>
			{{Form::close()}}

		{!!Form::open(array('url'=>'almacen/inventario/ean','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">

			@foreach($pEAN as $pE)
			Producto automático:
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$pE->id_producto}}">
			<input type="text" class="form-control" name="producto" value="{{$pE->nombre}}">
			@endforeach

			<?php
			$valor=count($pEAN);
			?>
			@if($valor==0)
			Producto<br>
			<select name="producto_id_producto" class="form-control">
				@foreach($producto as $p)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endforeach
			</select>
			@endif
			
	
			Disponible<br>
			<select name="disponibilidad" class="form-control">
					
				<option value="1">Disponible</option>
				<option value="0">No disponible</option>
	
			</select>
			Cantidad<br>
			<input type="text" class="form-control" name="cantidad">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar Producto</button><a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Volver</a>
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