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
    <!-- datepicker CSS-->
    <link href="../../../../css/datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- datatables CSS -->
    <link rel="stylesheet" type="text/css" href="../../../../css/jquery.dataTables.min.css">
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Gestão utilizadores</title>



    <script language="JavaScript" type="text/javascript">
    function checkDelete() {
        var x = $('[name="id_utilizador[]"]:checked').length;
            if(x>0){ 
            var confirmed = confirm("Pretende eliminar os utilizadores selecionados?");
                if(confirmed){
                document.getElementById('form1').submit();
                return true;
                }
            }else{
            swal("Aviso!", 
            "Selecione os utilizadores que pretende eliminar!", 
            "error");
            return false;
            }
        }
    </script>
  </head>


<body>

<div class="container">    
    <?php include "../../../../assets/breadcrumbers/bc_gestao_utilizadores.php" ?>
    <div class="card col-sm-12">
      <div class="card-header d-flex justify-content-between">
        <button class="btn btn-success" id="myButton" type="button" name="answer"> Novo utilizador</button>
        <h3>Gestão de utilizadores</h3>
        <a class="btn btn-danger mx-1" href="javascript:{}" onclick="checkDelete()"><i class="fa fa-trash"></i> Eliminar utilizador</a>
      </div>
      <p><br>Listagem de todos os utilizadores do sistema e dados relativos aos mesmos.</p>
      <div class="card" id="card-novo-condominio" style="display:none;">
        <form id="form3" method="POST" action="adicionar_utilizador.php">
        <div class="card-header">
          <h5 id="h1-centered">Insira os dados do novo utilizador:</h5>
        </div>
        <div class="card-body">
          <div class="form-group" id="codCondominioSelector">
            <label class="form-label">Nome:</label>
            <div>
              <input type="text" form="form3" name="nome" class="form-control" placeholder="Insira o nome completo"/ Required>  
            </div>
          </div>
          <div class="form-group">
            <label for="data_agendamento">Data Nascimento:</label>
            <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom left" name="data_nascimento" id="data_agendamento" required>
          </div>
          <div class="form-group">
            <div>
              <label class="form-label">Número Contribuinte:</label>
              <input type="text" form="form3" class="form-control" name="n_contribuinte" id="inputContribuinte" placeholder="Insira um número de 9 digitos" pattern="[0-9]{9}">
            </div>          
            <div>
              <label class="form-label">Telemóvel:</label>
              <input type="tel" form="form3" name="telemovel" class="form-control col-sm-8" placeholder="Insira um número de 9 digitos" required pattern="[0-9]{9}">
            </div>
            <div>
              <label class="form-label">Email:</label>
              <input type="email" form="form3" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="font-weight-bold">Palavra-passe:</label>
              <input type="password" class="form-control" id="password" placeholder="Password" name="senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange='check_pass();' Required>
              <small id="passHelp" class="form-text text-muted">A palavra-passe deve conter um mínimo de 8 caracteres, incluíndo pelo menos: um algarismo, uma letra maiúscula e uma letra minúscula.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="font-weight-bold">Confirme a palavra-passe:</label>
              <input type="password" class="form-control" id="confirm_password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange='check_pass();' Required>
              <span id='message'></span>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Tipo de Utilizador:</label>
            <div>
                <select id="gruposelector" name="id_grupo" class="form-control" required>
                    <option value=""></option>
                    <?php
                    $query_1="SELECT id_grupo, nome FROM grupo";
                    $result = mysqli_query($conn, $query_1);
                    while($row_result=mysqli_fetch_assoc($result)){ ?>
                <option value="<?php echo $row_result['id_grupo']; ?>"><?php echo utf8_encode($row_result['nome']); ?></option> <?php
                    }
                        ?>
                </select>
            </div>
          </div>    
          <div class="d-flex justify-content-center">
            <button form="form3" class="btn btn-success" id="submit" type="submit"> Adicionar</button>
          </div>
        </div>
        </form>
      </div>
      <div class="card-body">
          <form method="POST" id="form1" action="eliminar_utilizadores.php">
          <table id="data" class="table table-condensed table-hover table-striped bootgrid-table display" cellspacing="0" style="table-layout: fixed; width: 100%;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"/></th>
                    <th>Nome</th>
                    <th>Email</th>  
                    <th>Telemóvel</th>
                    <th>Ativo</th>
                    <th>Grupo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT grupo.nome as nome_grupo, utilizador.id_utilizador, utilizador.nome, email, telemovel, ativo FROM utilizador LEFT JOIN utilizador_grupo ON utilizador_grupo.id_utilizador=utilizador.id_utilizador LEFT JOIN grupo ON grupo.id_grupo=utilizador_grupo.id_grupo";
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
              while($rows = mysqli_fetch_assoc($resultset)) {
              ?>
                <tr>
                    <td class="col-sm-1"><input type="checkbox" name="id_utilizador[]" value="<?php echo $rows['id_utilizador']; ?>" multiple></td>
                    <td><?php echo utf8_encode($rows["nome"]); ?></td>
                    <td><?php echo utf8_encode($rows["email"]); ?></td>
                    <td><?php echo utf8_encode($rows["telemovel"]); ?></td>
                    <td><?php if($rows["ativo"]==NULL || $rows["ativo"]=="0"){echo "Não";}else{echo "Sim";} ?></td>
                    <td><?php echo utf8_encode($rows["nome_grupo"]); ?></td>
                    <td class="d-flex justify-content-center">
                        <form method="POST" id="form2" action="alterar_utilizador.php">
                          <button form="form2" name="id_utilizador" class="btn btn-info" type="submit" value="<?php echo utf8_encode($rows["id_utilizador"]); ?>"> Alterar</button>
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
<!-- Compara as duas pw's introduzidas -->
<script src="../../../../js/compare_pw.js"></script>
<!-- Optional JavaScript -->
<script src="../../../../js/datepicker.min.js"></script>
<script src="../../../../js/i18n/datepicker.pt.js"></script>
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
        { "width": "25%", "targets": 1 },
        { "width": "20%", "targets": 2 },
        { "width": "20%", "targets": 3 },
        { "width": "10%", "targets": 4 }
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
  if(isset($_COOKIE["utilizador_alterado"])){
?>
      <script>
      swal({
            title: "Utilizador alterado!",
            text: "Utilizador alterado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["utilizador_adicionado"])){
?>
      <script>
      swal({
            title: "Utilizador adicionado!",
            text: "O seu registo foi efetuado com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
<?php
  if(isset($_COOKIE["utilizador_eliminado"])){
?>
      <script>
      swal({
            title: "Utilizador eliminado!",
            text: "Os utilizadores foram eliminados com sucesso!",
            icon: "success",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
