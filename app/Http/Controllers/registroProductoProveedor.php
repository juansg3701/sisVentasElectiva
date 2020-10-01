<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorSedeFormRequest;
use DB;

class registroProductoProveedor extends Controller
{
	
			 	
	 	public function index(Request $request){
	 				if ($request) {
	 				$query=trim($request->get('searchText'));

	 	
	 		$producto=DB::table('producto')->get();
	 			$query=trim($request->get('searchText'));
			$pEAN=DB::table('producto')
			->where('ean','=',$query)
			->get();
	 			
	 	

	 		return view("almacen.inventario.ean.index",["producto"=>$producto,"pEAN"=>$pEAN,"searchText"=>$query]);
	 	}
	 	}

	 	public function create(Request $request){
	 			 		if ($request) {
	 				$query=trim($request->get('searchText'));
	 		$producto=DB::table('producto')->get();
	 			$query=trim($request->get('searchText'));
			$pEAN=DB::table('producto')
			->where('ean','=',$query)
			->get();
	 			
	 		return view("almacen.inventario.proveedor-sede.registrar.registrar",["producto"=>$producto,"pEAN"=>$pEAN,"searchText"=>$query]);
	 	}
	 	}

	 	public function store(ProveedorSedeFormRequest $request){
	 		$ps = new ProveedorSede;
	 		$ps->producto_id_producto=$request->get('producto_id_producto');
	 		$ps->disponibilidad=$request->get('disponibilidad');
	 		$ps->cantidad=$request->get('cantidad');
	 		$ps->save();

	 		return back()->with('msj','Producto guardado');
	 	}

	 	public function show($id){
	 		
	 	}

}