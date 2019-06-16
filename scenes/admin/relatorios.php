<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="icon" href="https://i.imgur.com/SzFkxr6.png">
<?php
    include __DIR__.'/../../headers/admin_header.php';
    
    if(isset($_SESSION['id_grupo'])=='admin' || isset($_SESSION['id_utilizador'])){
        $id_utilizador=$_SESSION['id_utilizador'];  
        include __DIR__.'/../../core/connect.php';
    }else header('Location: ../../index.php');
?>
<html>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <button type="button" onclick="">Print PDF</button>
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
    <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Condomínio</strong></h1>
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

        var chart = new google.visualization.PieChart(document.getElementById('condominio_chart_div'));
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

        var chart = new google.visualization.PieChart(document.getElementById('incidente_chart_div'));
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
  </head>
  <body>
        <div id="condominio_chart_div" style="width: 100%; height: 500px;"></div>
        <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Categoria de Incidente</strong></h1>
        <div id="incidente_chart_div" style="width: 100%; height: 500px;"></div>
        <input class="google-analytics-id-json" type="hidden" value="{&quot;dimensions&quot;: {&quot;dimension6&quot;: null, &quot;dimension5&quot;: &quot;pt-pt&quot;, &quot;dimension3&quot;: false, &quot;dimension8&quot;: &quot;scriptsafe&quot;, &quot;dimension1&quot;: &quot;Signed out&quot;}, &quot;gaid&quot;: &quot;UA-24532603-1&quot;}">
        <input class="google-analytics-id-json" type="hidden" value="{&quot;dimensions&quot;: {}, &quot;gaid&quot;: &quot;UA-47037920-1&quot;}">
  </body>
</html>
