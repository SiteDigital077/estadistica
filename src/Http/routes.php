<?php


Route::group(['middleware' => ['auths','administrador']], function (){

Route::get('gestion/estadisticav', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@index');

Route::get('gestion/estadistica/meses', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@meses');

Route::get('gestion/estadistica/mapa', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@mapa');

Route::get('gestion/estadistica/keywords', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@keywords');

Route::get('gestion/estadistica/paginas', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@paginas');

Route::get('gestion/estadistica/idioma', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@idioma');

Route::get('gestion/estadistica/referidos', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@referidos');

Route::get('gestion/estadistica/bloqueo', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@blocks');

Route::post('gestion/estadistica/crearbloqueo', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@crearblocks');

Route::get('gestion/estadistica/eliminar/{id}', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@eliminar');



Route::get('/gestion/estadistica/crear-block', function(){

    return View::make('estadistica::crear-block');
});





Route::get('informe/estadistica', function(){
       
       $min_price = Input::has('min_price') ? Input::get('min_price') : 0;
       $max_price = Input::has('max_price') ? Input::get('max_price') : 10000000;
       $clientes =  Input::get('cliente') ;
       $estados =  Input::get('estado') ;
   
     
         $unitarios =  $productos = DB::table('estadistica')
          ->selectRaw('count(ip) as sum')
          ->get();


        
   return View::make('estadistica::indexa')->with('unitarios', $unitarios);
});


Route::get('gestion/estadistica', 'DigitalsiteSaaS\Estadistica\Http\EstadisticaController@homeestadistica');





});

 Route::get('/mensajes/estadisticas', 'DigitalsiteSaaS\Pagina\Http\WebController@estadistica');