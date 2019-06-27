<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="icon" href="https://i.imgur.com/SzFkxr6.png">
<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include __DIR__.'/../../headers/admin_header.php';
$id_utilizador=$_SESSION['id_utilizador'];  
include __DIR__.'/../../core/connect.php';
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<div class="d-flex justify-content-center">
<div class="card col-sm-12">   
<div class="card-header d-flex justify-content-between">
   <form method="post" id="make_pdf" action="create_pdf.php">
    <input type="hidden" name="hidden_html" id="hidden_html" />
    <button type="button" name="create_pdf" id="create_pdf" class="btn btn-primary m-1">Imprimir em PDF</button>
   </form>
   <h3>Relatórios</h3>
   <a type="hidden"></a>
   </div>
   

   
<html>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="dashboard_div">
    <br>
    <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Zona e por Seleção de Condomínio</strong></h1>
    <div id="categoryPicker_div" style="text-align:center;"></div>  
    <div id="chart_div" style="width: 100%; height: 500px;"></div>  
    </div>
    <div id="dashboard_div">
    <br>
    <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Condomínio e por Seleção de Ano</strong></h1>
    <div id="categoryPicker2_div" style="text-align:center;"></div>  
    <div id="chart_div2" style="width: 100%; height: 500px;"></div>  
    </div>
    <script type="text/javascript">

      
      google.charts.load('current', {'packages':['corechart', 'table', 'gauge', 'controls']});
      google.charts.setOnLoadCallback(drawMainDashboard);

      google.charts.setOnLoadCallback(drawcondominioChart);

      google.charts.setOnLoadCallback(drawincidenteChart);
      google.charts.setOnLoadCallback(drawMainDashboard2);

      function drawcondominioChart() {

        var data = google.visualization.arrayToDataTable([

['nome_condominio','incidentes'],
<?php 
            $query ="SELECT condominio.nome as nome_condominio, zona.nome as nome_zona, incidente.id_zona, COUNT(id_incidente) as incidentes FROM incidente INNER JOIN zona ON incidente.id_zona=zona.id_zona INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio GROUP BY condominio.id_condominio";  
            $result = mysqli_query($conn, $query);
        
            while($row = mysqli_fetch_array($result)){
                echo utf8_encode("['".$row['nome_condominio']."',".$row['incidentes']."],");
                 }
            ?> 

]);

        var options = {
            pieSliceTextStyle: {color: 'white'},
            is3D: true,
            legend: {position: 'right'},
                       };

        var chart_area = document.getElementById('condominio_chart_div');
        var chart = new google.visualization.PieChart(chart_area);
           
        google.visualization.events.addListener(chart, 'ready', function(){
        chart_area.innerHTML = '<img src="' + chart.getImageURI() + '" class="img-responsive">';
    });

        chart.draw(data, options);
      }

      function drawincidenteChart() {

        var data = google.visualization.arrayToDataTable([
          ['nome_categoria', 'incidentes'],
 <?php 
 $query = "SELECT incidente.id_categoria_incidente, COUNT(incidente.id_incidente) as incidentes, categoria_incidente.nome as nome_categoria FROM categoria_incidente INNER JOIN incidente ON incidente.id_categoria_incidente=categoria_incidente.id_categoria_incidente GROUP BY id_categoria_incidente";

 $exec = mysqli_query($conn,$query);
 while($row = mysqli_fetch_array($exec)){

 echo utf8_encode("['".$row['nome_categoria']."',".$row['incidentes']."],");
 }
 ?>
 
 ]);

        var options = {
          legend: {position: 'bottom'},
          pieHole: 0.5
          };

        var chart_area = document.getElementById('incidente_chart_div');
        var chart = new google.visualization.PieChart(chart_area);
           
        google.visualization.events.addListener(chart, 'ready', function(){
        chart_area.innerHTML = '<img src="' + chart.getImageURI() + '" class="img-responsive">';
    });



        chart.draw(data, options);
    
      }

      function drawMainDashboard() {
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));
      
        var categoryPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'categoryPicker_div',
          'options': {
            'filterColumnIndex': 0,
            'ui': {
              'labelStacking': 'vertical',
              'label': 'Escolha o Condomínio:',
              'caption': 'Condomínio:',
              'allowTyping': false,
              'allowMultiple': false
            }
          }
        });
        var pie = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div',
          'options': {
            legend: {position: 'right'},
            pieSliceTextStyle: {color: 'white'},
          },
          'view': {'columns': [1, 2]}
        });
  
 
        var data = google.visualization.arrayToDataTable([

          ['nome_condominio','nome_zona','incidentes'],
          <?php 
                      $query ="SELECT condominio.nome as nome_condominio, zona.nome as nome_zona, incidente.id_zona, COUNT(id_incidente) as incidentes FROM incidente INNER JOIN zona ON incidente.id_zona=zona.id_zona INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio GROUP BY id_zona";  
                      $result = mysqli_query($conn, $query);
                  
                      while($row = mysqli_fetch_array($result)){
                          echo utf8_encode("['".$row['nome_condominio']."','".$row['nome_zona']."',".$row['incidentes']."],");
                          }
                      ?> 

          ]);


    dashboard.bind([categoryPicker], [pie]);
    dashboard.draw(data);
  }

  function drawMainDashboard2() {
        var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));
      
        var categoryPicker2 = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'categoryPicker2_div',
          'options': {
            'filterColumnIndex': 0,
            'ui': {
              'labelStacking': 'vertical',
              'label': 'Escolha o Ano:',
              'caption': 'Ano:',
              'allowTyping': false,
              'allowMultiple': false
            }
          }
        });
        
        var pie = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart_div2',
          'options': {
            legend: {position: 'right'},
            pieSliceTextStyle: {color: 'white'},
          },
          'view': {'columns': [1, 2]}
        });
  
        var data = google.visualization.arrayToDataTable([

          ['data_incidente','nome_condominio','incidentes'],
          <?php 
                      $query ="SELECT year(data_incidente) as data_incidente, condominio.nome as nome_condominio, COUNT(id_incidente) as incidentes 
                      FROM incidente INNER JOIN zona ON incidente.id_zona=zona.id_zona 
                      INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio 
                      GROUP BY year(data_incidente), condominio.nome";  
                      $result = mysqli_query($conn, $query);
                  
                      while($row = mysqli_fetch_array($result)){
                          echo utf8_encode("['".$row['data_incidente']."','".$row['nome_condominio']."',".$row['incidentes']."],");
                          }
                      ?> 

          ]);

    dashboard.bind([categoryPicker2], [pie]);
    dashboard.draw(data);
  }

    </script>
  <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
  </head>
  <body>
  <div class="container" id="testing"> 
  <div class="panel-body" align="center">
        <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Condomínio</strong></h1>
        <div id="condominio_chart_div" style="width: 100%; height: 500px;"></div>
        <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Categoria de Incidente</strong></h1>
        <div id="incidente_chart_div" style="width: 100%; height: 500px;"></div>
    </div>
    </div>
    </div>
    </div>
       </body>
</html>
<script>
$(document).ready(function(){
 $('#create_pdf').click(function(){
  $('#hidden_html').val($('#testing').html());
  $('#make_pdf').submit();
 });
});
</script>