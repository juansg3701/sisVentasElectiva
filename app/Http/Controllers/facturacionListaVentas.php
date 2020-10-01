<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Factura;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\FacturaFormRequest;
use DB;

class facturacionListaVentas extends Controller
{

	 	public function index(Request $request){
	 		if ($request) {
	 			$query=trim($request->get('searchText'));
	 			$query1=trim($request->get('searchText1'));

	 		
	 
	 			$clientes=DB::table('cliente')->get();
	 			$tipoPago=DB::table('tipo_pago')->get();
			
				$BuscarCliente=DB::table('cliente')
				->where('documento','=',$query1)
				->orderBy('documento', 'desc')
	 			->paginate(10);

	 			$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			return view('almacen.facturacion.listaVentas.nuevaVenta',["searchText"=>$query,"searchText1"=>$query1, "clientes"=>$clientes,"tipoPago"=>$tipoPago,"BuscarCliente"=>$BuscarCliente,"clientesP"=>$clientesP]);
	 		}
	 	}

	 	public function edit($id){

	 			$id=$id;


	 		$query="";
	 		$query1="";


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

	 public function create(){
	 		
	 			
	 			return view("almacen.facturacion.listaVentas.registrar");
	

	 	}

	 	public function store(FacturaFormRequest $request){
	 		$fact = new Factura;
	 		$fact->pago_total=$request->get('pago_total');
	 		$fact->noproductos=$request->get('noproductos');
	 		$fact->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$fact->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$fact->fecha=$request->get('fecha');
	 		$fact->facturaPaga=$request->get('facturaPaga');
	 		$fact->tiendaodomicilio=$request->get('tiendaodomicilio');
	 		
	 		$fact->save();

	 		$id=$fact->id_factura;


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

	 	
	 		public function show(Request $request){
	 		$query=trim($request->get('searchText'));
	 		

	 		$facturas=DB::table('factura as f')
	 		->join('tipo_pago as tp','f.tipo_pago_id_tpago','=','tp.id_tpago')
	 		->join('cliente as c','f.cliente_id_cliente','=','c.id_cliente')
	 		->select('f.id_factura as id_factura','tp.nombre as tipo_pago_id_tpago','c.nombre as cliente_id_cliente', 'f.fecha as fecha','f.pago_total as pago_total','f.noproductos as noproductos','f.tiendaodomicilio as tiendaodomicilio',
	 			'f.facturaPaga as facturaPaga')
	 			->where('fecha','LIKE', '%'.$query.'%')
	 			->orderBy('f.id_factura', 'desc')
	 			->paginate(10);


	 	
	 	return view('almacen.facturacion.listaVentas.listaVentas', ["facturas"=>$facturas, "searchText"=>$query]);
	 	}

	 	public function update(FacturaFormRequest $request, $id){
	 		$fact = Factura::findOrFail($id);
	 		$fact->pago_total=$request->get('pago_total');
	 		$fact->noproductos=$request->get('noproductos');
	 		$fact->tipo_pago_id_tpago=$request->get('tipo_pago_id_tpago');
	 		$fact->cliente_id_cliente=$request->get('cliente_id_cliente');
	 		$fact->fecha=$request->get('fecha');
	 		$fact->tiendaodomicilio=$request->get('tiendaodomicilio');
	 		$fact->facturaPaga=$request->get('facturaPaga');
	 		$fact->update();
	 		return Redirect::to('almacen/facturacion/listaVentas');
	 	}

	 	public function destroy($id){

	 		$id=$id;

	 		$existeDF=DB::table('detalle_factura')
	 			->where('factura_id_factura','=',$id)
	 			->orderBy('id_detallef', 'desc')->get();


	 			if(count($existeDF)==0){
	 				$fact=Factura::findOrFail($id);
	 				$fact->delete();
	 					
	 				return back()->with('msj','Venta eliminada');
	 			}
	 			else{
	 		
	 			return back()->with('errormsj','¡Venta con productos o cartera activa!');

	 			}
	 	}
}