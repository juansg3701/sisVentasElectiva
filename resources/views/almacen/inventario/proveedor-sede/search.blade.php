{!! Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	Nombre:
		 <br>
		<input id="buscar2" type="text" class="form-control" name="searchText0" placeholder="Buscar..." >
	
		</br>
	PLU:
	<br>
		<input id="pluP"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." >
	
	</br>
	
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>



</div>

{{Form::close()}}