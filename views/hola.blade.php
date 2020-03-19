@extends ('LayoutsSD.TemaSD')

 @section('cabecera')
 @parent
 
 @stop


 @section('ContenidoSite-01')
  @foreach($datos as $datos)
<?php

@include('gapi.class.php');
define('ga_profile_id',$datos->correo);

$ga = new gapi("165634436677-96d4oakadbpohnlbeuudboaqjq0277bk@developer.gserviceaccount.com", "sitedigital-61ff14e4af33.p12");


$ga->requestReportData(
    ga_profile_id,
    array('userType','country'),
    array('pageviews','visits','bounces','newUsers','users')
    );
?>
@endforeach

 <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 topper a">
  
<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search blue-bg"></i>
  <span class="headline">Visitas</span>
  <span class="value"><?php echo $ga->getVisits() ?></span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search green-bg"></i>
  <span class="headline">Usuario Nuevo</span>
  <span class="value"><?php echo $ga->getnewUsers()?></span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search yellow-bg"></i>
  <span class="headline">Retorno Usuario</span>
  <span class="value"><?php echo $ga->getVisits()-$ga->getnewUsers()?>
  </span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search red-bg"></i>
  <span class="headline">Paginas Vistas</span>
  <span class="value"><?php echo $ga->getPageviews() ?></span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search lightblue-bg"></i>
  <span class="headline">Paginas/Visitas</span>
  <span class="value"><?php echo round( $ga->getPageviews()/$ga->getVisits(),2)?></span>
 </div>
</div>

<div class="col-lg-3 col-sm-6 col-xs-12">
 <div class="main-box infographic-box">
  <i class="glyphicon glyphicon-search yell-bg"></i>
  <span class="headline">Porcentaje Rebote</span>
  <span class="value"><?php echo round( $ga->getBounces()/$ga->getVisits()*100,2)?>%</span>
 </div>
</div>

</div>






 <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
 <div class="wrapper">
  <div class="h_iframe">
   <!-- a transparent image is preferable -->
   <img class="ratio1"/>
   <iframe scrolling="no" src="<?=URL::to('gestion/estadistica/meses');?>" frameborder="0" allowfullscreen></iframe>
  </div>
 </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
 <div class="wrapper">
  <div class="h_iframe">
   <!-- a transparent image is preferable -->
   <img class="ratio1"/>
   <iframe scrolling="no" src="<?=URL::to('gestion/estadistica/mapa');?>" frameborder="0" allowfullscreen></iframe>
  </div>
 </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 torta">
 <div class="wrapper">
  <div class="h_iframe">
   <!-- a transparent image is preferable -->
   <img class="ratio"/>
   <iframe scrolling="no" src="<?=URL::to('gestion/estadistica/idioma');?>" frameborder="0" allowfullscreen></iframe>
  </div>
 </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 torta">
 <div class="wrapper">
  <div class="h_iframe">
   <!-- a transparent image is preferable -->
   <img class="ratio"/>
   <iframe scrolling="no" src="<?=URL::to('gestion/estadistica/referidos');?>" frameborder="0" allowfullscreen></iframe>
  </div>
 </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
 <div class="wrapper">
  <div class="h_iframe">
   <!-- a transparent image is preferable -->
   <img class="ratio"/>
   <iframe scrolling="no" src="<?=URL::to('gestion/estadistica/keywords');?>" frameborder="0" allowfullscreen></iframe>
  </div>
 </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
 <div class="wrapper">
  <div class="h_iframe">
   <!-- a transparent image is preferable -->
   <img class="ratio"/>
   <iframe scrolling="no" src="<?=URL::to('gestion/estadistica/paginas');?>" frameborder="0" allowfullscreen></iframe>
  </div>
 </div>
</div>


</div>

@stop
