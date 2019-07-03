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
 $query = "SELECT incidente.id_categoria_incidente, COUNT(incidente.id_incidente) as incidentes, categoria_incidente.nome as nome_categoria 
    FROM categoria_incidente 
    INNER JOIN incidente ON incidente.id_categoria_incidente=categoria_incidente.id_categoria_incidente 
    GROUP BY id_categoria_incidente";
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

      function drawMainDashboard() { /* INCIDENTES P/ ZONA E P/ SELECAO CONDOMINIO*/
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
        var pie = new google.visualization.ChartWrapper({ //GRÁFICO
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
    $query ="SELECT condominio.nome as nome_condominio, zona.nome as nome_zona, incidente.id_zona, COUNT(id_incidente) as incidentes 
                FROM incidente INNER JOIN zona ON incidente.id_zona=zona.id_zona 
                INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio 
                GROUP BY id_zona";  
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
        echo utf8_encode("['".$row['nome_condominio']."','".$row['nome_zona']."',".$row['incidentes']."],");
    }
?> 
        ]);
    dashboard.bind([categoryPicker], [pie]);
    dashboard.draw(data);
  }

  function drawMainDashboard2() { //INCIDENTES POR CONDOMINIO E POR SELECAO DO ANO
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