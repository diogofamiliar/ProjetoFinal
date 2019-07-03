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
  
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/custom.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>   
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <?php include "../../core/fetch_results/relatorios_handle.php"; /*ficheiro onde é feita a construção dos gráficos e preenchimento de dados */?> 
    </head>
    <body>
    
    

    <div class="container"> 
        <?php include "../../assets/breadcrumbers/bc_relatorios.php" ?>
        <div>
            <h1 id="h1-centered"> Relatórios</h1>
            <div class="d-flex justify-content-center">
                <form method="post" id="make_pdf" action="create_pdf.php">
                    <input type="hidden" name="hidden_html" id="hidden_html" />
                    <button type="button" name="create_pdf" id="create_pdf" class="btn btn-primary m-1">Imprimir em PDF</button>
                </form>
            </div>
        </div>
        <div class="card my-4">
            <div class="card-header">
                <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Zona e por Seleção de Condomínio</strong></h1>
            </div>
            <div class="card-body">
                <div id="dashboard_div">   
                    <div id="categoryPicker_div" style="text-align:center;"></div>  
                    <div id="chart_div" style="width: 100%; height: 500px;"></div> 
                </div>
            </div>
        </div>
        <div class="card my-4">
            <div class="card-header">
                <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Condomínio e por Seleção de Ano</strong></h1>
            </div>
            <div class="card-body">
                <div id="dashboard_div">   
                    <div id="categoryPicker2_div" style="text-align:center;"></div>  
                    <div id="chart_div2" style="width: 100%; height: 500px;"></div>  
                </div>
            </div>
        </div>
        <div id="testing">
            <div class="card  my-4">
                <div class="card-header">
                    <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Condomínio</strong></h1>
                </div>
                <div class="card-body">
                    <div class="panel-body" align="center">   
                        <div id="condominio_chart_div" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
            <div class="card  my-4">
                <div class="card-header">
                    <h1 style="font-size:160%; text-align:center;"><strong>Incidentes por Categoria de Incidente</strong></h1>
                </div>
                <div class="card-body">
                    <div class="panel-body" align="center">   
                        <div id="incidente_chart_div" style="width: 100%; height: 500px;"></div>
                    </div>
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