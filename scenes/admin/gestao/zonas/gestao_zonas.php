<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
  include "../../../../core/connect.php";
	include '../../../../headers/admin_header.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" /> 
    <title>Gestão zonas</title>



    <script language="JavaScript" type="text/javascript">
    function checkDelete() {
        var x = $('[name="id_zona[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende eliminar as zonas selecionadas?");
                if(confirmed){
                document.getElementById('form1').submit();
                return true;
                }
            }else{
            swal("Aviso!", 
            "Selecione as zonas que pretende eliminar!", 
            "error");
            return false;
            }
        }
    </script>
  </head>


<body>

<div class="container">
    <?php include "../../../../assets/breadcrumbers/bc_gestao_zonas.php" ?>
    <div class="card col-sm-12">
      <div class="card-header d-flex justify-content-between">
        <button class="btn btn-success" id="myButton" type="button" name="answer"> Nova zona</button>
        <h3>Gestão de zonas</h3>
        <a class="btn btn-danger mx-1" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar zona</a>
      </div>
      <p><br>Listagem de todas as zonas dos condomínios e dados relativos às mesmas.</p>
      <div class="card" id="card-novo-condominio" style="display:none;">
        <form id="form3" method="POST" action="adicionar_zona.php">
        <div class="card-header">
          <h5 id="h1-centered">Insira os dados da nova zona:</h5>
        </div>
        <div class="card-body">
          <div class="form-group" id="codCondominioSelector">
            <label class="col-form-label">Selecione o condominio ao qual pertence a nova zona:</label>
            <div class="col-11">
                <input type="text" name="id_condominio" id="id_condominio" class="form-control" placeholder="Comece a digitar e selecione uma das opções"/ Required>  
                <div id="lista_condominios"></div>
              </div>
          </div>  
          <div class="form-group row">
            <div class="row col-sm-7">
              <label for="inputNome" class="col-sm-2 col-form-control">Morada:</label>
              <input type="text" form="form3" name="morada" class="form-control col-sm-10" id="inputNome" placeholder="Insira a morada"  required>
            </div>          
            <div class="row col-sm-5">
              <label for="inputCodCondominio" class="col-sm-4 col-form-control">Entrada:</label>
              <input type="text" form="form3" name="nome" class="form-control col-sm-8" id="inputCodCondominio" placeholder="Nº porta"  required>
            </div>

          </div> 
          <div class="d-flex justify-content-center">
            <button form="form3" class="btn btn-success" type="submit"> Adicionar</button>
          </div>
        </div>
        </form>
      </div>
      <div class="card-body">
          <form method="POST" id="form1" action="eliminar_zonas.php">
          <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"/></th>
                    <th>COD</th>
                    <th>Condominio</th>  
                    <th>Entrada</th>
                    <th>Morada</th>  
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT zona.id_zona as id_zona, zona.cod_zona as cod_zona, zona.nome as entrada, zona.morada as morada, condominio.cod_condominio as cod_condominio FROM zona INNER JOIN condominio ON zona.id_condominio=condominio.id_condominio ORDER BY zona.id_zona ASC";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
                <tr>
                    <td class="col-sm-1"><input type="checkbox" name="id_zona[]" value="<?php echo $rows['id_zona']; ?>" multiple></td>
                    <td><?php echo utf8_encode($rows["id_zona"]); ?></td>
                    <td><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
                    <td><?php echo utf8_encode($rows["entrada"]); ?></td>
                    <td><?php echo utf8_encode($rows["morada"]); ?></td>
                    <td class="d-flex justify-content-center">
                        <form method="POST" id="form2" action="alterar_zona.php">
                          <button form="form2" name="id_zona" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_zona"]); ?>"> Editar</button>
                        </form>
                    </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
        </table>
          
          </form>
      </div>  
      </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../../../../js/jquery-3.4.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Optional JavaScript -->
<script>
$('#myButton').click(function() {
  $('#card-novo-condominio').toggle('slow', function() {
    // Animation complete.
  });
});
</script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    
    $('#data').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "10%", "targets": 1 },
        { "width": "15%", "targets": 2 },
        { "width": "20%", "targets": 3 },
        { "width": "35%", "targets": 4 },
        { "width": "15%", "targets": 5 }
      ],
      "language": {
        "search": "Pesquisar:",
        "info":           "A mostrar _START_ de _END_ num total de _TOTAL_ resultados",
        "lengthMenu":     "Resultados por página: _MENU_",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Ultimo",
          "next":       "Próximo",
          "previous":   "Anterior"
        }
      },
      select: true,
      "scrollX": true
    });
  });
</script>
<script>
  $("#checkAll").change(function () {
  $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>

<?php
  if(isset($_COOKIE["zona_alterada"])){
?>
      <script>
      swal({
            title: "Zona alterada!",
            text: "Zona alterada com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["zona_adicionada"])){
?>
      <script>
      swal({
            title: "Zona adicionada!",
            text: "Zona adicionada com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["zona_eliminada"])){
?>
      <script>
      swal({
            title: "Zona eliminada!",
            text: "As zonas foram eliminadas com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<script>
    $(document).ready(function(){  
    $('#id_condominio').keyup(function(){
            var query = $(this).val();  
            if(query != '')  
            {  
                $.ajax({  
                    url:"../../../../core/fetch_results/fetch_condominio_1.php",
                    method:"POST",  
                    data:{query:query},  
                    success:function(data)  
                    {  
                        $('#lista_condominios').fadeIn();  
                        $('#lista_condominios').html(data);  
                    }  
                });  
            }  
    });  
    $(document).on('click', 'li', function(){  
            $('#id_condominio').val($(this).text());  
            $('#lista_condominios').fadeOut();  
    });  

    });
</script>
</body>
</html>
