<?php
    include __DIR__.'/../../headers/admin_header.php';
    
    if(isset($_SESSION['id_grupo'])=='admin' || isset($_SESSION['id_utilizador'])){
        $id_utilizador=$_SESSION['id_utilizador'];  
        include __DIR__.'/../../core/connect.php';
    }else header('Location: ../../index.php');
?>

<html>
<head>
 <meta charset="utf-8">
 <title>TechJunkGigs</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
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
 title: 'Número de Incidentes por Condomínio',
 titleTextStyle: {
     fontSize: 20,
    },
  pieHole: 0,
          pieSliceTextStyle: {
            color: 'white',
          },
          is3D: true,
          legend: {
              position: 'bottom'
              },
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);

 }
	
    </script>

</head>
<body>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>

</body>
</html>
    