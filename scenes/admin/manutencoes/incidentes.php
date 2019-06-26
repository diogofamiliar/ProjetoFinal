<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
  include "../../../core/connect.php";
	include '../../../headers/admin_header.php';
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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Gestão manutenções</title>

<script language="JavaScript" type="text/javascript">
function checkDelete() {
    var x = $('[name="id_incidente[]"]:checked').length;
        if(x>0){ 
        var confirmed = confirm("Pretende eliminar as manutenções?");
            if(confirmed){
            document.getElementById('form1').submit();
            return true;
            }
        }else{
        swal("Aviso!", 
        "Selecione as manutenções que pretende eliminar!", 
        "error");
        return false;
        }
    }


</script>
<script language="JavaScript" type="text/javascript">
function OnButtonManu(){
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
function OnButtonLista(){
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
<script language="JavaScript" type="text/javascript">
function OnButtonEdit(){
  var x = $('[name="id_incidente[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende pretende editar os incidentes selecionados?");
                if(confirmed){
                  document.Form1.action = "editar_incidente.php"
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

<div class="d-flex justify-content-center">
    <div class="card col-sm-11">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-primary m-1" href="javascript:{}" onclick="return OnButtonManu();" style="width:165px;">Inserir manutenção</a>
                    <a class="btn btn-primary m-1" href="javascript:{}" onclick="return OnButtonLista();" style="width:165px;">Criar lista de tarefas</a>
                </div>
                <div>
                    <a href="registo_incidente.php" class="btn btn-success m-1" id="myButton" type="button" name="answer" style="width:165px;"><i class="fa fa-plus-square"></i> Registar incidente</a>
                    <a class="btn btn-danger m-1" href="javascript:{}" onclick="checkDelete()" style="width:165px;"><i class="fa fa-trash"></i> Eliminar Incidente</a>
                    <a class="btn btn-primary m-1" href="javascript:{}" onclick="return OnButtonEdit();" style="width:165px;"><i class="fa fa-pencil"></i> Editar Incidente </a>
                </div>
            </div>  
        </div>
      <div class="card-body">
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
          <td class="d-flex justify-content-center"><input type="checkbox" name="id_incidente[]" value="<?php echo $rows['id_incidente']; ?>" multiple></td>
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
          <div class="container">
          <div class="row">
         
<?php
          while($row = mysqli_fetch_assoc($resultset1)) {
?>

<div class="col-xs-auto">
          <a href="\ProjetoFinal\uploads\fotografias\<?php echo utf8_encode($row['caminho']);?>"><img  name="fotos" style="" title="foto" src="\ProjetoFinal\uploads\fotografias\<?php echo utf8_encode($row['caminho']);?>">
  </div>
    <?php } ?>
    </div>
    </div>
  
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
<script src="../../../js/jquery-3.4.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    
    $('#data').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },    //checkbox
        { "width": "10%", "targets": 1 },   //Data
        { "width": "10%", "targets": 2 },   //Condominio
        { "width": "10%", "targets": 3 },   //Local
        { "width": "30%", "targets": 4 },   //Descricao
        { "width": "10%", "targets": 5 },   //Avaria
        { "width": "15%", "targets": 6 }    //Fotografia
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

<?php
  if(isset($_COOKIE["condominio_alterado"])){
?>
      <script>
      swal({
            title: "Sucesso!",
            text: "O condomínio foi alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

<?php
  if(isset($_COOKIE["manutencao_eliminada"])){
?>
      <script>
      swal({
            title: "Manutenção eliminada!",
            text: "As manutenções foram eliminadas com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

</body>
</html>
