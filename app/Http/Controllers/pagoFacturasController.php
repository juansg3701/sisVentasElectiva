<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Cliente;
use sisVentas\Factura;
use sisVentas\ProveedorSede;
use sisVentas\DetalleBanco;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use sisVentas\Http\Requests\DetalleBancoFormRequest;
use DB;

class pagoFacturasController extends Controller
{
	
	 	public function index(Request $request){
	 		//$id=2;	
	 		if ($request) {
	 			$id=trim($request->get('id_factura'));

	 			
	 			$facturas=DB::table('factura')->get();
	 			return view('almacen.facturacion.pagoEfectivo.index',["id"=>$id,"facturas"=>$facturas ]);
				}	
	 		}
	 	
 	public function store(DetalleBancoFormRequest $request){
 		

 	}

 	public function update(DetalleBancoFormRequest $request, $id){
				
 				$tpago=$request->get('tipo_pago');
 				$id=$id;

 				$detalleProductos=DB::table('detalle_factura')
	 			->orderBy('id_detallef', 'desc')->get();

	 		

 				switch ($tpago) {
 					case 1:
 					 	
				$fact= Factura::findOrFail($id);
						 $fact->facturaPaga=1;	 		
						 $fact->update();

		
		

	 				return back()->with('msj','Pago en efectivo registrado');

 						break;

 			case 2:



	 			$fact= Factura::findOrFail($id);
				 $fact->facturaPaga=1;
				 $fact->tipo_pago_id_tpago=2;	 		
				 $fact->update();
				

				return back()->with('msj','Pago con datafono registrado');	
 						break;
 					
 					default:
 						# code...
 						break;
 				}
	 	
 	}

 	public function show($id){
 		$id=$id;
 		

	 	$facturasPagos=DB::table('factura')
		->where('id_factura','=',$id)
	 	->orderBy('id_factura', 'desc')->get();

	 	$detalleProductos=DB::table('detalle_factura')
	 	->orderBy('id_detallef', 'desc')->get();

					 		
 	return view('almacen.facturacion.pagoPasarela.index',["id"=>$id,"facturasPagos"=>$facturasPagos]);	

 	}

 	public function create(FacturaFormRequest  $request){
 	 
 	}
}
