<?php


namespace DigitalsiteSaaS\Estadistica\Http;
use DigitalsiteSaaS\Pagina\Date;
use App\Http\Controllers\Controller;
use DigitalsiteSaaS\Estadistica\Stats;
use DigitalsiteSaaS\Pagina\Content;
use DigitalsiteSaaS\Estadistica\Ips;
use DB;
use Input;

use Illuminate\Http\Request;
class EstadisticaController extends Controller{


 public function __construct()
    {
        $this->middleware('auth');
    }

	
public function index(){

		$meses = Stats::all()->groupBy('mes');
	    $paginas = Stats::all()->groupBy('pagina');
	    $ciudades = Stats::all()->groupBy('ciudad');
		$paises = Stats::all()->groupBy('pais');
		$referidos = Stats::all()->groupBy('referido');
		$idiomas = Stats::all()->groupBy('idioma');
		$visitas = DB::table('estadistica')->count();
		$jobs = Stats::select('ip')->distinct()->count('ip');
		$conteopag = DB::table('pages')->count();
		
        return view('estadistica::estadisticas')->with('visitas', $visitas)->with('meses', $meses)->with('jobs', $jobs)->with('paginas', $paginas)->with('ciudades', $ciudades)->with('paises', $paises)->with('referidos', $referidos)->with('conteopag', $conteopag)->with('idiomas', $idiomas);
	
	}


public function meses(){
	 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::meses')->with('datos', $datos);
	
	}

	public function mapa(){
 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::mapa')->with('datos', $datos);
	
	}


		public function keywords(){
 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::keywords')->with('datos', $datos);
	
	}


		public function paginas(){
 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::paginas')->with('datos', $datos);
	
	}


		public function idioma(){
 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::idioma')->with('datos', $datos);
	
	}

			public function referidos(){
 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::referidos')->with('datos', $datos);
	
	}

		public function visitas(){
 $datos = Date::where('id','=',2)->get();
	    return view('estadistica::estadisticas')->with('datos', $datos);
	
	}

		public function blocks(){
        $ips = DB::table('ips')->get();
	    return view('estadistica::block')->with('ips', $ips);
	
	}

		public function crearblocks(){

	$pagina = new Ips;
	$pagina->ip = Input::get('ips');
	$pagina->save();
    return Redirect('gestion/estadistica/bloqueo')->with('status', 'ok_create');
	}


		public function eliminar($id){

		$pagina = Ips::find($id);
		$pagina->delete();
		
		return Redirect('/gestion/estadistica/bloqueo')->with('status', 'ok_delete');
	}




}
