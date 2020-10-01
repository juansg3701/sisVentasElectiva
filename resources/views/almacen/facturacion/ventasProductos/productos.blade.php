@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Ventas</title>
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
                  <p class="card-category">Añadir productos</p>
                </div>
                <div class="card-body">
                <div class="form-group">
                	
<div align="center" id=formulario>
	<div >
		<div align="center">
			<div class="form-group" align="center">
				
			
			{!! Form::open(array('url'=>'almacen/facturacion/ventasProductos','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
			
                <br>EAN:<input id="tags" class="form-control" name="searchText" placeholder="Buscar..." >
                </br><br>
                <input type="hidden" class="form-control" name="factura_id_factura" value="{{$id}}">
					Nombre:
					<input id="buscar2" class="form-control" name="searchText1" placeholder="Buscar..." ></br><br><br><input type="submit" class="btn btn-primary" value="Buscar">
					</br>
			{{Form::close()}}

		</div>
			{!!Form::open(array('url'=>'almacen/facturacion/ventasProductos','method'=>'POST','autocomplete'=>'off'))!!}
    		{{Form::token()}}


			<br>
    		Número de factura:  {{$id}}
			<input type="hidden" class="form-control" name="factura_id_factura" value="{{$id}}">
			<br>
    		<?php
			$Enable="disabled";
			?>
			<?php 
			$contador=0;
			$contador2=0;
			$contadorB=0;
			$contadorB2=0;
			$conteoProductos1=count($productosEAN);
			$conteoProductos2=count($productosEAN2);
			$nombre="";
			?>

			@if($conteoProductos1!=0)
			<br>
			<br>
			@foreach($productosEAN as $EAN)

			@if($EAN->cantidad<=$EAN->minimo && $contador2=='0')
			<?php 
			$contador2=1;
			?>
			 <script >
			 	window.alert("Producto con pocas unidades");
			 </script>
			@endif
			


			@if($EAN->cantidad>0 && $contador=='0' && $EAN->disponible=='1')

			<?php 
			$contador=1;
			?>

			Nombre Producto: <input type="text" class="form-control" name="nombre" value="({{$EAN->nombre}})">
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
			<br>
			Precio unitario:<input type="text" class="form-control" name="precio_venta" value="{{$EAN->precioU}}">
			<br>
			
			
			
			@if($EAN->nombre!='')
			<?php
			$Enable="enable";
			?>	
			@endif
			@endif
			@endforeach
			@endif


			@if($searchText1!="")
			
			@foreach($productosEAN2 as $EAN)
			
			@if($EAN->cantidad<=$EAN->minimo && $contadorB2=='0')
			<?php 
			$contadorB2=1;
			?>
			 <script >
			 	window.alert("Producto con pocas unidades");
			 </script>
			@endif


			@if($EAN->cantidad>0 && $contadorB=='0' && $EAN->disponible=='1')


			<?php 
			$contadorB=1;
			?>

			Nombre Producto: <input type="text" class="form-control" name="nombre" value="({{$EAN->nombre}})">
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
			<br>
			Precio unitario:<input type="text" class="form-control" name="precio_venta" value="{{$EAN->precioU}}">
			<br>
			

			@if($EAN->nombre!='')
			<?php
			$Enable="enable";
			?>	
			@endif
			@endif

			
			@endforeach
			@endif

	
			@if($searchText!="" && $contadorB!='1' && $contador!='1')
			<script >
			 	window.alert("Producto no disponible");
			 </script>
			@endif

			@if($searchText1!="" && $contadorB!='1' && $contador!='1')
			<script >
			 	window.alert("Producto no disponible");
			 </script>
			@endif


			<br>
			Cantidad: <br>
			<input type="text" class="form-control" name="cantidad" value="1">
			<br>
			<br>
			Fecha: <input type="datetime" class="form-control" name="fecha" value="<?php echo date("Y/m/d"); ?>">

			<br> 
			
			<input type="hidden" class="form-control" name="total" value="0">
			@foreach($facturas as $f)
					@if($f->id_factura==$id)
						@if($f->facturaPaga=='1')
							<?php
							$Enable="disabled";
							?>
						@endif
					@endif
			@endforeach

			<br>
			<br>
			<br>
			<div align="center">			
				<button href="" class="btn btn-info" type="submit" <?php echo $Enable?>>Guardar productos</button>
			<a href="{{URL::action('facturacionListaVentas@show',0)}}" class="btn btn-danger">Volver</a>
			</div>
			</div>

{!!Form::close()!!}	
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
                  <p class="card-category"> Productos agregados</p>
                </div>

                <div class="card-body">
				<div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
							<th>ID </th>
							<th>ID FACTURA</th>
							<th>PRODUCTO</th>
							<th>CANTIDAD</th>
							<th>PRECIO UNITARIO</th>
							<th>PAGO TOTAL</th>
							<th>OPCIONES</th>

						</thead>
						
						@foreach($productos as $p)
						<tr>
							<td>{{$p->id_detallef}}</td>
							<td>{{$p->factura_id_factura}}</td>
							<td>{{$p->producto_id_producto}}</td>
							<td>{{$p->cantidad}}</td>
							<td>{{$p->precio_venta}}</td>
							<td>{{$p->total}}</td>

							<td>
						
								<a href="" data-target="#modal-delete-{{$p->id_detallef}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.facturacion.ventasProductos.modal')
						@endforeach
					</table>
					<div align="center">
						
					@foreach($facturas as $f)
					@if($f->id_factura==$id && $f->pago_total!=0)
							@if($f->tipo_pago_id_tpago=='1'  && $f->facturaPaga=='0')
							
							<a href="" data-target="#modal-pagar-{{$id}}" data-toggle="modal"><button href="" class="btn btn-info">Pagar</button></a>
							

						
							<a href="
								{{URL::action('FacturaController@create',$id)}}" target="_blank"><button class="btn btn-primary" disabled="true">Generar XML</button></a>
							@else
							<a href="" data-target="#modal-pagar-{{$id}}" data-toggle="modal"><button href="" class="btn btn-info" disabled="true">Pagar</button></a>
							
							<a href="
								{{URL::action('FacturaController@show',$id)}}" target="_blank"><button class="btn btn-primary">Generar XML</button></a>
							@endif
					
					@endif
					
					@endforeach
					
				@include('almacen.facturacion.pagoEfectivo.pago')
				</div>
				</div>
				</div>
						
			</div>
			
			</div><br>
		</div>
		
@stop



