<?php
    include __DIR__.'/../../headers/admin_header.php';
    
    if(isset($_SESSION['id_grupo'])=='admin' || isset($_SESSION['id_utilizador'])){
        $id_utilizador=$_SESSION['id_utilizador'];  
        include __DIR__.'/../../core/connect.php';
    }else header('Location: ../../index.php');
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawcondominioChart);

      google.charts.setOnLoadCallback(drawincidenteChart);

      function drawcondominioChart() {

        var data = google.visualization.arrayToDataTable([

['nome_condominio','incidentes'],
<?php 
            $query ="SELECT condominio.nome as nome_condominio, zona.nome as nome_zona, incidente.id_zona, COUNT(id_incidente) as incidentes FROM incidente INNER JOIN zona ON incidente.id_zona=zona.id_zona INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio GROUP BY id_zona";  
            $result = mysqli_query($conn, $query);
        
            while($row = mysqli_fetch_array($result)){
                echo utf8_encode("['".$row['nome_condominio']."',".$row['incidentes']."],");
                 }
            ?> 

]);

        var options = {
            title:'Número de Incidentes por Condomínio',
            titleTextStyle:{fontSize: 20},
            pieSliceTextStyle: {color: 'white'},
            is3D: true,
            legend: {position: 'bottom'},
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

 echo "['".$row['nome_categoria']."',".$row['incidentes']."],";
 }
 ?>
 
 ]);

        var options = {
          title:'Número de Incidentes por Categoria de Incidente',
          titleTextStyle:{fontSize: 20},
          legend: 'none'

          };

        var chart = new google.visualization.ColumnChart(document.getElementById('incidente_chart_div'));
        chart.draw(data, options);
    
      }
    </script>
  </head>
  <body>
        <div id="condominio_chart_div" style="width: 100%; height: 500px;"></div>
        <div id="incidente_chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>
