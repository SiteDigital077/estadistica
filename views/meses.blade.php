 @foreach($datos as $datos)
<?php
 @include('gapi.class.php');
 define('ga_profile_id',$datos->correo);

$ga = new gapi("165634436677-96d4oakadbpohnlbeuudboaqjq0277bk@developer.gserviceaccount.com", "sitedigital-61ff14e4af33.p12");

  $desde = '2013-01-01';
  $today = date('Y-m-d');
  $search = array("2009","2010","01","02","03","04","05","06","07","08","09","10","11","12");
  $replace = array("","","Enr","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dec");
  $search2 = array ("<");
  $replace2 = array ("");

  $ga->requestReportData(ga_profile_id,array('month'),array('users'),array('month') ,$filter=null,$start_date=$desde,$end_date=$today,$start_index=1,$max_results=12);?>


<script type="text/javascript" src="//www.google.com/jsapi"></script>
<script type="text/javascript">
 window.onresize = function(){
 startDrawingChart();};
 window.onload = function(){
 startDrawingChart();};
 startDrawingChart = function(){
 google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 function drawChart() {
 var data = new google.visualization.DataTable();
 data.addColumn('string','Ciudad');
 data.addColumn('number','visitas');
 var dataTemp =[];
 
<?php
 $i = 0;
 foreach($ga->getResults() as $result):
?>

 dataTemp[<?php echo $i ?>] = ['<?php echo str_replace($search,$replace,$result) ?>',<?php echo $result->getusers() ?> ]

<?php
 $i++;
 endforeach
?>
  @endforeach    
 data.addRows(dataTemp);
 
 var options = {
 title: 'Company Performance',
 height:400,
 hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}};
 var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
 chart.draw(data, options);}};
</script>
 <div id="chart_div"></div>