<?php


namespace DigitalsiteSaaS\Estadistica\Http;
use DigitalsiteSaaS\Pagina\Date;
use App\Http\Controllers\Controller;
use DigitalsiteSaaS\Estadistica\Stats;
use DigitalsiteSaaS\Pagina\Content;
use DigitalsiteSaaS\Estadistica\Ips;
use DigitalsiteSaaS\Estadistica\Page;
use DB;
use Input;
use Illuminate\Http\Request;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;


class EstadisticaController extends Controller{


protected $tenantName = null;

 public function __construct(){
  $this->middleware('auth');

  $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
        if ($hostname){
            $fqdn = $hostname->fqdn;
            $this->tenantName = explode(".", $fqdn)[0];
        }

 }

	
public function index(){
     if(!$this->tenantName){
		$meses = Stats::all()->groupBy('mes');
	    $paginas = Stats::all()->groupBy('pagina');
	    $ciudades = Stats::all()->groupBy('ciudad');
		$paises = Stats::all()->groupBy('pais');
		$referidos = Stats::all()->groupBy('referido');
		$idiomas = Stats::all()->groupBy('idioma');
		$visitas = Stats::count();
		$jobs = Stats::select('ip')->distinct()->count('ip');
		$conteopag = Page::count();
      }else{
        $meses = \DigitalsiteSaaS\Estadistica\Tenant\Statss::all()->groupBy('mes');
        $paginas = \DigitalsiteSaaS\Estadistica\Tenant\Stats::all()->groupBy('pagina');
        $ciudades = \DigitalsiteSaaS\Estadistica\Tenant\Stats::all()->groupBy('ciudad');
        $paises = \DigitalsiteSaaS\Estadistica\Tenant\Stats::all()->groupBy('pais');
        $referidos = \DigitalsiteSaaS\Estadistica\Tenant\Stats::all()->groupBy('referido');
        $idiomas = \DigitalsiteSaaS\Estadistica\Tenant\Stats::all()->groupBy('idioma');
        $visitas = \DigitalsiteSaaS\Estadistica\Tenant\Stats::count();
        $jobs = \DigitalsiteSaaS\Estadistica\Tenant\Stats::select('ip')->distinct()->count('ip');
        $conteopag = \DigitalsiteSaaS\Estadistica\Tenant\Page::count();
      }
		
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
	if(!$this->tenantName){
    $ips = Ips::all();
	}else{
	$ips = \DigitalsiteSaaS\Estadistica\Tenant\Ips::all();	
	}
	return view('estadistica::block')->with('ips', $ips);
	
	}

	public function crearblocks(){

	if(!$this->tenantName){
	$pagina = new Ips;
	}{
	$pagina = new \DigitalsiteSaaS\Estadistica\Tenant\Ips;	
	}
	$pagina->ip = Input::get('ips');
	$pagina->save();
    return Redirect('gestion/estadistica/bloqueo')->with('status', 'ok_create');
	}


	public function eliminar($id){
	if(!$this->tenantName){
	$pagina = Ips::find($id);
	}else{
	$pagina = \DigitalsiteSaaS\Estadistica\Tenant\Ips::find($id);	
	}
	$pagina->delete();
		
	return Redirect('/gestion/estadistica/bloqueo')->with('status', 'ok_delete');
	}


	public function homeestadistica(){

	$min_price = Input::has('min_price') ? Input::get('min_price') : 0;
    $max_price = Input::has('max_price') ? Input::get('max_price') : 10000000;

    if(!$this->tenantName){
    $visitas = Stats::whereBetween('fecha', array($min_price, $max_price))
    ->count();

    $nuevousuario = Stats::whereBetween('fecha', array($min_price, $max_price))
    ->select('ip')
    ->distinct()
    ->count('ip');

	$conteopagina = Page::count(); 

	$paginas = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('pagina')
     ->selectRaw('count(ip) as sum')
     ->groupBy('pagina')
     ->orderBy('sum', 'desc')
     ->get();


   $referidos = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('referido')
     ->selectRaw('count(ip) as sum')
     ->groupBy('referido')
     ->orderBy('sum', 'desc')
     ->get();

       $ciudades = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('ciudad')
     ->selectRaw('count(ip) as sum')
     ->groupBy('ciudad')
     ->orderBy('sum', 'desc')
     ->get();

          $fuentes = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('utm_source')
     ->where('utm_source','<>','NULL')
     ->selectRaw('count(ip) as sum')
     ->groupBy('utm_source')
     ->orderBy('sum', 'desc')
     ->get();



      $idiomas = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('idioma')
     ->selectRaw('count(ip) as sum')
     ->groupBy('idioma')
     ->orderBy('sum', 'desc')
     ->get();

      $meses = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('mes')
     ->selectRaw('count(ip) as sum')
     ->groupBy('mes')
      ->orderBy('cp', 'asc')
     ->get();

      $paises = Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('pais')
     ->selectRaw('count(ip) as sum')
     ->groupBy('pais')
     ->get();
 	}else{

 	$visitas = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
    ->count();

    $nuevousuario = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
    ->select('ip')
    ->distinct()
    ->count('ip');

	$conteopagina = \DigitalsiteSaaS\Estadistica\Tenant\Page::count(); 

	$paginas = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('pagina')
     ->selectRaw('count(ip) as sum')
     ->groupBy('pagina')
     ->orderBy('sum', 'desc')
     ->get();


   $referidos = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('referido')
     ->selectRaw('count(ip) as sum')
     ->groupBy('referido')
     ->orderBy('sum', 'desc')
     ->get();

       $ciudades = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('ciudad')
     ->selectRaw('count(ip) as sum')
     ->groupBy('ciudad')
     ->orderBy('sum', 'desc')
     ->get();

     $fuentes = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
      ->select('utm_source')
     ->where('utm_source','<>','NULL')
     ->selectRaw('count(ip) as sum')
     ->groupBy('utm_source')
     ->orderBy('sum', 'desc')
     ->get();


      $idiomas = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('idioma')
     ->selectRaw('count(ip) as sum')
     ->groupBy('idioma')
     ->orderBy('sum', 'desc')
     ->get();

      $meses = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('mes')
     ->selectRaw('count(ip) as sum')
     ->groupBy('mes')
      ->orderBy('cp', 'asc')
     ->get();

      $paises = \DigitalsiteSaaS\Estadistica\Tenant\Stats::whereBetween('fecha', array($min_price, $max_price))
     ->select('pais')
     ->selectRaw('count(ip) as sum')
     ->groupBy('pais')
     ->get();

 	}

	return View('estadistica::estadisticaweb', compact(['visitas','nuevousuario','conteopagina','paginas','referidos','ciudades','idiomas','meses','paises','fuentes']));


	}




}
