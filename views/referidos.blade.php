 @foreach($datos as $datos)
<?php
 @include('gapi.class.php');
 define('ga_profile_id',$datos->correo);

$ga = new gapi("165634436677-96d4oakadbpohnlbeuudboaqjq0277bk@developer.gserviceaccount.com", "sitedigital-61ff14e4af33.p12");

 $dimensions  = array('source');
 $metrics     = array('visits','pageviews','bounces');
 $sort_metric = '-visits';
                              
 $ga->requestReportData(ga_profile_id,      
  $dimensions, 
  $metrics, 
  $sort_metric, 
  $filter=null, 
  $start_date=null, 
  $end_date=null, 
  $start_index=1, 
  $max_results=10);
?>
@endforeach
<script type="text/javascript" src="//www.google.com/jsapi"></script>
<script type="text/javascript">
 window.onresize = function(){
 startDrawingChart();};
 window.onload = function(){
 startDrawingChart();};
 startDrawingChart = function(){
 google.load("visualization", "1", {packages:["table"],callback: drawChart});
 function drawChart() {
 var data = new google.visualization.DataTable();
 data.addColumn('string','Referidos');
 data.addColumn('number','visitas');
 var dataTemp =[];
<?php
 $i = 0;
 foreach($ga->getResults() as $result):
?>

 dataTemp[<?php echo $i ?>] = ['<?php echo $result ?>',<?php echo $result->getVisits()?>]


<?php
 $i++;
 endforeach
?>
      
 data.addRows(dataTemp);
 
 var options = {
 title: 'Company Performance',
 width:'100%',
 height:500,
 colorAxis: {colors: ['#000', '#000']}};
 var chart = new google.visualization.Table(document.getElementById('chart_div'));
 chart.draw(data, options);}};
 </script>
  <div id="chart_div"></div>

