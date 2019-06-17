<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/custom.css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>elVecino | Manutenções</title>


<script language="JavaScript" type="text/javascript">
function OnButton1()
{
  var x = $('[name="id_incidente[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende agendar os itens selecionados?");
                if(confirmed){
                  document.Form1.action = "inserir_manutencao.php"
                  document.Form1.submit();             // Submit the page
                  return true;
                }
            }else{
            swal("Selecione checkboxs!", 
            "Selecione os itens que pretende agendar!", 
            "error");
            return true;
            }
}
</script>
<script language="JavaScript" type="text/javascript">
function OnButton2()
{
  var x = $('[name="id_incidente[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende pretende criar uma lista de tarefas com os itens selecionados?");
                if(confirmed){
                  document.Form1.action = "inserir_lista.php"
                  document.Form1.submit();             // Submit the page
                  return true;
                }
            }else{
            swal("Selecione checkboxs!", 
            "Selecione itens para criar uma lista de tarefas!", 
            "error");
            return true;
            }
}
</script>
  </head>


<body>

	<?php
  include "../../../core/connect.php";
	include __DIR__.'/../../../headers/admin_header.php';
	?>


  
  <h1 id="h1-centered">Lista de incidentes registados</h1>
  <div class="container">
  <form name="Form1" method="POST">
    <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll"/></th>
          <th>Data</th>
          <th>Condominio</th>
          <th>Local</th>
          <th>Descrição</th>  
          <th>Avaria</th>
          <th>Fotografia</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT incidente.id_incidente AS id_incidente, data_incidente, condominio.cod_condominio AS cod_condominio, zona.nome AS entrada, descricao, id_categoria_incidente  
        FROM incidente INNER JOIN zona ON incidente.id_zona = zona.id_zona 
        INNER JOIN condominio ON condominio.id_condominio = zona.id_condominio 
        LEFT JOIN fotografia ON incidente.id_incidente=fotografia.id_incidente 
        LEFT JOIN incidente_manutencao ON incidente.id_incidente = incidente_manutencao.id_incidente 
        WHERE incidente_manutencao.id_incidente IS NULL GROUP BY id_incidente;";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

        while($rows = mysqli_fetch_assoc($resultset)) {

        ?>
      <tr>
      <?php $id_incidente=$rows['id_incidente']; ?>
          <td class="col-sm-1"><input type="checkbox" name="id_incidente[]" value="<?php echo $rows['id_incidente']; ?>" multiple></td>
          <td><?php echo utf8_encode($rows["data_incidente"]); ?></td>
          <td><?php echo utf8_encode($rows["cod_condominio"]); ?></td>
          <td><?php echo utf8_encode($rows["entrada"]); ?></td>
          <td><?php echo utf8_encode($rows["descricao"]); ?></td>
          <td><?php echo utf8_encode($rows["id_categoria_incidente"]); ?></td>
<?php
          $sql1="SELECT caminho FROM fotografia WHERE id_incidente=$id_incidente";
          $resultset1 = mysqli_query($conn, $sql1) or die("database error:". mysqli_error($conn));
?>
          <td>
<?php
          while($row = mysqli_fetch_assoc($resultset1)) {
?>
          <a href="\ProjetoFinal\uploads\fotografias\<?php echo utf8_encode($row['caminho']);?>"><img  name="fotos" style="width: 70px; height: 70px;" title="foto" src="\ProjetoFinal\uploads\fotografias\<?php echo utf8_encode($row['caminho']);?>">
    <?php } ?>
    </td>
      </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
    <INPUT class="btn btn-primary btn-lg" type="button" value="Inserir manutencao" name="button1" onclick="return OnButton1();" placeholder="lista">
    <INPUT class="btn btn-primary btn-lg" type="button" value="Criar lista tarefas" name="button2" onclick="return OnButton2();" placeholder="lista">

    </form>
  </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../../js/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        
        $('#data').DataTable({
          "columnDefs": [
            { "width": "10px", "targets": 0 },
            { "width": "80px", "targets": 1 },
            { "width": "70px", "targets": 2 },
            { "width": "200px", "targets": 3 },
            { "width": "200px", "targets": 4 },
            { "width": "50px", "targets": 5 },
            { "width": "70px", "targets": 6 }
          ],
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
</body>