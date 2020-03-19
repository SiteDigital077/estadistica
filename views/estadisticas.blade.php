@extends ('LayoutsSD.TemaSD')

 @section('cabecera')
 @parent
 
 @stop


 @section('ContenidoSite-01')







   <style>
      .span3 {  
    height: 260px !important;
    overflow: scroll;
}
      </style>
      


<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 topper a">
  
<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search blue-bg"></i>
  <span class="headline">Visitas</span>
  <span class="value">{{$visitas}}</span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search green-bg"></i>
  <span class="headline">Usuario Nuevo</span>
  <span class="value">{{$jobs}}</span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search yellow-bg"></i>
  <span class="headline">Retorno Usuario</span>
  <span class="value"> {{$visitas-$jobs}}</span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search lightblue-bg"></i>
  <span class="headline">Paginas/Visitas</span>
  <span class="value">{{number_format($visitas/$conteopag,2)}}</span>
 </div>
</div>

</div>



<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 topper a">

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

       <div class="span3">
    <table class="table table-striped">
      <thead class="thead-inverse" style="background:#1abc9c;color:#fff">
        <tr>
          <th>Pagina</th>
          <th>No visitas</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          @foreach($paginas as $page => $pagePaginas)
          @foreach($pagePaginas as $pagina)
          @endforeach
          <td>{{ $pagina->pagina }}</td>
          <td>{{count($pagePaginas)}}</td>
        </tr>
        @endforeach     
      </tbody>
    </table>

      
    </div>

      
</div>
      


<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

       <div class="span3">
    <table class="table table-striped">
      <thead class="thead-inverse" style="background:#1b1d1f;color:#fff">
        <tr>
          <th>Página referencia</th>
          <th>No Visitas</th>
        </tr>
      </thead>
      <tbody>
        <tr>
         @foreach($referidos as $referer => $refererReferidos)
         @foreach($refererReferidos as $referido)
         @endforeach
         @if($referido->referido == '')
          <td>/</td>
          @else
          <td>{{ $referido->referido }}</td>
          @endif
          <td>{{count($refererReferidos)}}</td>
        </tr>
        @endforeach     
      </tbody>
    </table>

      
    </div>

      
</div>


<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<br><br><br>
       <div class="span3">
    <table class="table table-striped">
      <thead class="thead-inverse" style="background:#1b1d1f;color:#fff">
        <tr>
          <th>#</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        @foreach($ciudades as $city => $cityCiudades)
        @foreach($cityCiudades as $ciudad)
        @endforeach
          <td>{{ $ciudad->ciudad }}</td>
          <td>{{count($cityCiudades)}}</td>
        </tr>
        @endforeach     
      </tbody>
    </table>

      
    </div>

      
</div>



<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<br><br><br>
       <div class="span3">
    <table class="table table-striped">
      <thead class="thead-inverse" style="background:#1abc9c;color:#fff">
        <tr>
          <th>Lenguaje</th>
          <th>No Visitas</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        @foreach($idiomas as $language => $languageIdiomas)
        @foreach($languageIdiomas as $idioma)
        @endforeach
          <td>{{ $idioma->idioma }}</td>
          <td>{{count($languageIdiomas)}}</td>
        </tr>
        @endforeach     
      </tbody>
    </table>

      
    </div>

      
</div>


</div>







    <script src="/estadistica/chartkick.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <!-- <script src="Chart.bundle.js"></script> -->
    <script type="text/javascript" src="//www.google.com/jsapi"></script>
 
    <script>
      // Chartkick.configure({language: "de"});
      // Chartkick.configure({mapsApiKey: "test123"})
      // Chartkick.options = {colors: ["#b00", "#666"]};
      // Chartkick.options = {legend: "right"};
      // Chartkick.options = {title: "Bingo"};

      var CustomAdapter = new function () {
        this.name = "custom";

        // this.renderLineChart = function (chart) {
        //   chart.getElement().innerHTML = "Hi";
        // };

        this.renderCustomChart = function (chart) {
          chart.getElement().innerHTML = "Custom Chart";
        };
      };

      Chartkick.CustomChart = function (element, dataSource, options) {
        Chartkick.createChart("CustomChart", this, element, dataSource, options);
      };

      Chartkick.adapters.unshift(CustomAdapter);
    </script>

    <style>

      Rect {
   stroke: black;
   fill: #d8d8d8;
 }
      h1 {
        text-align: center;
      }

    </style>

    
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1">
    
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">
    	<h3><b>Visitas por mes</b></h3>
    <div id="column" style="height:400px;"></div>
</div>
    <script>
      new Chartkick.ColumnChart("column", [
@foreach($meses as $month => $monthMeses)
 
 @foreach($monthMeses as $mes)
 @endforeach
      	["{{ $mes->mes }}",{{count($monthMeses)}}],
      	@endforeach
      	]);

    </script>
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-6">
   <h3><b>Visitas por país</b></h3>
    <div id="geo" style="height:400px"></div>
</div>
    <script>
      new Chartkick.GeoChart("geo", [
	@foreach($paises as $country => $countryPaises)
 
 @foreach($countryPaises as $pais)
     
     @endforeach
	["{{ $pais->pais }}",{{count($countryPaises)}}],
@endforeach
	]);


    </script>
  </div>




@stop


