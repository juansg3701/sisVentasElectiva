<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Sede;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Request\SedeFormRequest;
use DB;

class admin extends Controller
{

	 	public function index(Request $request){
	 		if ($request) {
	 			
	 	

	 			$clientesP=DB::table('cliente')
	 			->orderBy('id_cliente', 'desc')->get();

	 			
	 			return view('layouts.admin',["clientesP"=>$clientesP]);
	 		}
	 	}
}