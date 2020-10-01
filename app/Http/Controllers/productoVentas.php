<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\ProductosFactura;
use sisVentas\Factura;
use sisVentas\ProveedorSede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProductosFacturaFormRequest;
use DB;


class productoVentas extends Controller
{

	 	public function index(Request $request){
	 		if ($request) {
	 			$id=trim($request->get('factura_id_factura'));
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));

	 			$productos=DB::table('detalle_factura as df')
	 			->join('factura as f','df.factura_id_factura','=','f.id_factura')
	 			->join('stock as s','df.producto_id_producto','=','s.id_stock')
	 			->join('producto as p','s.producto_id_producto','=','p.id_producto')
	 			->select('df.id_detallef as id_detallef','df.cantidad as cantidad','df.precio_venta as precio_venta','f.id_factura as factura_id_factura','p.nombre as producto_id_producto','df.total as total')
	 			->where('df.factura_id_factura','=',$id)
	 			->orderBy('df.id_detallef', 'desc')
	 			->paginate(10);
	 			
	 			$productosEAN=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('p.id_stock as id_producto','pr.precio as precioU','pr.nombre as nombre','p.cantidad as cantidad','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('ean','=',$query)
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
	 			->orderBy('ean', 'desc')
	 			->paginate(10);
	 		
	 			
	 			$productosEAN2=DB::table('stock as p')
	 			->join('producto as pr','p.producto_id_producto','=','pr.id_producto')
	 			->select('p.id_stock as id_producto','pr.precio as precioU','pr.nombre as nombre','p.cantidad as cantidad','pr.stock_minimo as minimo','p.disponibilidad as disponible' )
	 			->where('pr.nombre','LIKE', '%'.$query1.'%')
	 			->orderBy('ean', 'desc')
	 			->paginate(10);

	 		
	 			$productoGeneral=DB::table('producto')->get();

	 			$facturas=DB::table('factura')->get();

	 			$tipoPago=DB::table('tipo_pago')->get();

				$eanP=DB::table('producto')
	 			->orderBy('id_producto', 'desc')->get();

	 			if($query!="" && $query1!=""){
	 				$query1="";
	 				$query="";
	 			}

	 			$conteo=true;

	 			return view('almacen.facturacion.ventasProductos.productos',["searchText"=>$query,"searchText1"=>$query1, "productos"=>$productos,"productosEAN"=>$productosEAN,"productosEAN2"=>$productosEAN2, "id"=>$id, "productoGeneral"=>$productoGeneral,"facturas"=>$facturas,"tipoPago"=>$tipoPago,"eanP"=>$eanP,"conteo"=>$conteo]);
	 		}
	 	}


	public function create(){
	 			$tiempo=DB::table('p_tiempo')->get();
	 			
	 			return view("almacen.inventario.corte-sede.productosCorte.registrar",["tiempo"=>$tiempo]);
	 		
	 	}


	 	public function store(ProductosFacturaFormRequest $request){

	 		$cantidadR=$request->get('cantidad');
	 		$productoR=$request->get('producto_id_producto');

	 		$existeR=DB::table('stock')
	 		->where('cantidad','>=',$cantidadR)
	 		->where('id_stock','=',$productoR)
	 		->get();

	 		if(count($existeR)!=0){
			
			$ps = new ProductosFactura;
	 		$cantidad=$cantidadR;
	 		$precio=$request->get('precio_venta');
	 		$idfactura=$request->get('factura_id_factura');
	 		$ps->cantidad=$cantidad;
	 		$ps->factura_id_factura=$idfactura;
	 		$ps->producto_id_producto=$productoR;
	 		$ps->precio_venta=$precio;
			$ps->total=$precio;
	 		$ps->save();

	 		$total=$cantidad*$precio;

	 		$fact = Factura::findOrFail($idfactura);
	 		$precioAnterior=$fact->pago_total;
	 		$productos=$fact->noproductos;

	 		$fact->pago_total=round($precioAnterior+$total,0);
	 		$fact->noproductos=$productos+$cantidad;
	 		$fact->update();

			$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA-$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto guardado y descontado del stock');

	 		}else{

	 			return back()->with('errormsj','No hay suficiente stock');
	 		}


	 	}


	 		public function show($id){
	 		return view("almacen.inventario.corte-sede.productosCorte.show",["productos"=>ProductosFactura::findOrFail($id)]);
	 	}

	 	public function update(ProductosFactura $request, $id){

	 		$precio=$request->get('precio_venta');
	 		$cantidad=$request->get('noproductos');
	 		$total=$precio*$cantidad;

	 		$fact = Factura::findOrFail($id);
	 		$precioAnterior=$fact->pago_total->get();
	 		$productos=$fact->noproductos->get();


	 		$fact->pago_total=$precio+$total;
	 		$fact->noproductos=$productos+$cantidad;
	 		$fact->update();

	 		return Redirect::to('almacen/facturacion/listaVentas');
	 	}

	 	public function destroy($idf){
	 		$productos=ProductosFactura::findOrFail($idf);
	 		$id=$productos->factura_id_factura;
	 		$idProducto=$productos->producto_id_producto;
	 		$can=$productos->cantidad;
	 		$to=$productos->total;
	 		$productos->delete();

	 		$fact = Factura::findOrFail($id);
	 		$precioAnterior=$fact->pago_total;
	 		$productosTotal=$fact->noproductos;

	 		$fact->pago_total=$precioAnterior-$to;
	 		$fact->noproductos=$productosTotal-$can;
	 		
	 		$fact->update();
	
	 		$cantidadR=$can;
	 		$productoR=$idProducto;

	 		$stockR = ProveedorSede::findOrFail($productoR);
	 		$cantidadA=$stockR->cantidad;
	 		$stockR->cantidad=$cantidadA+$cantidadR;
	 		$stockR->update();

	 		return back()->with('msj','Producto eliminado y sumado al stock');
	 	}
}