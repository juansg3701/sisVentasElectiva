@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos proveedor</title>
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
                  <p class="card-category">Editar Datos producto</p>
                </div>
                <div class="card-body">
                		{!!Form::model($stock,['method'=>'PATCH','route'=>['almacen.inventario.proveedor-sede.update',$stock->id_stock]])!!}
    {{Form::token()}}

	<div id=formulario>
Producto<br>
			<select name="producto_id_producto" class="form-control" value="{{$stock->producto_id_producto}}">
				@foreach($producto as $p)
				@if($stock->producto_id_producto==$p->id_producto)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endif
				@endforeach

				@foreach($producto as $p)
				@if($stock->producto_id_producto!=$p->id_producto)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endif
				@endforeach
			</select>	

			Disponible<br>
			<select name="disponibilidad" class="form-control" value="{{$stock->disponibilidad}}">
					
				@if($stock->disponibilidad=='1')
				<option value="1">Disponible</option>
				<option value="0">No disponible</option>
				@endif
				@if($stock->disponibilidad=='0')
				<option value="0">No disponible</option>
				<option value="1">Disponible</option>
				@endif
				
	
			</select>
			Cantidad<br>
			<input type="text" class="form-control" name="cantidad" value="{{$stock->cantidad}}">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Registrar Producto</button><a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Volver</a>
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