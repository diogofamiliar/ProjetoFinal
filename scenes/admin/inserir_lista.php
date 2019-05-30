<?php /*
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador']) && isset ($_POST['id_incidente'])){
    $id_incidente=$_POST['id_incidente'];
}else header('Location: ../../index.php');
*/?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/custom.css">
    <!-- datepicker CSS-->
    <link href="../../css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
$("#cab_data").datepicker({
    onSelect: function(dateText, inst) {
        var date = $(this).val();
        var time = $('#time').val();
        alert('on select triggered');
        $("#start").val(date + time.toString(' HH:mm').toString());
        console.log(date + time.toString(' HH:mm').toString());
    }
});
</script>


    <title>elVecino | Inserir Lista Tarefas</title>
  </head>

<body>

	<?php
  include "../../core/connect.php";
	include __DIR__.'/../../headers/admin_header.php';
	?>
  
<h1 id="h1-centered">Inserir Lista de tarefas:</h1>

<div class="container">
  <h2 >Informação:</h2>
  <p></p>
  <p> Para evitar que o utilizador tenha de inserir todos os campos manualmente, a barra cinzenta que se encontra a baixo permite pré definir uma data agendamento, uma equipa, a prioridade e ou o tipo de manutenção</p>
  <p> É possível definir o valor de um campo para os respetivos campos da página, bem como alterar um destes campos manualmente sem que os restantes se alterem.</p>
</div>


<div class="container my-5">
  <div class="card">
    <div class="card-header">
      <h4 id="h1-centered">Preencha a linha a baixo de forma a pré-definir os valores do restante formulário</h4>
    </div>
    <div class="card-header">
    <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Tipo manutenção:</label>
                    <select id="cab_tipo_manutencao" class="form-control tipo_manutencao" required onchange="fill_tipo_manutencao()">
                      <option selected=""></option>
                        <?php
                        $query_1="SELECT id_tipo_manutencao, descricao FROM tipo_manutencao ORDER BY descricao ASC";
                        $result = mysqli_query($conn, $query_1);
                        while($row_result=mysqli_fetch_assoc($result)){ ?>
                      <option value="<?php echo $row_result['id_tipo_manutencao']; ?>"><?php echo utf8_encode($row_result['descricao']); ?></option> <?php
                        }
                            ?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="prioridade" required>Prioridade:</label>
                    <select id="cab_prioridade" class="form-control prioridade" required onchange="fill_prioridade()">
                        <option value=""></option>
                        <option style="background: #009933; color: #fff;">Baixa</option>
                        <option style="background: #e65c00; color: #fff;">Média</option>
                        <option style="background: #cc2900; color: #fff;">Alta</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="data_agendamento">Data agendamento:</label>
                    <input id="cab_data" type="text" class="datepicker-here form-control cab_data" data-language='pt'data-position="bottom right"  required onchange="fill_data_manutencao()">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Equipa de manutenção:</label>
                    <select id="cab_equipa" class="form-control" required onchange="fill_equipa()">
                      <option value="">Selecione uma equipa</option>
                        <?php
                        $query_1="SELECT id_fornecedor, nome FROM fornecedor ORDER BY nome ASC";
                        $result = mysqli_query($conn, $query_1);
                        while($row_result=mysqli_fetch_assoc($result)){ ?>
                      <option value="<?php echo $row_result['id_fornecedor']; ?>"><?php echo utf8_encode($row_result['nome']); ?></option> <?php
                      }
                      ?>
                    </select>
                </div>
              </div>
    </div>
    <div class="card-body">
      <form>
        <?php
        $id_incidente=$_POST['id_incidente'];
        foreach ($id_incidente as $valor) {
          $sql="  SELECT incidente.data_incidente AS data_incidente, incidente.local as local, categoria_incidente.descricao as categoria_incidente, zona.nome AS entrada, incidente.descricao AS descricao, condominio.cod_condominio AS cod_condominio, condominio.morada AS morada
                  FROM incidente 
                  inner JOIN zona ON incidente.id_zona = zona.id_zona 
                  Inner JOIN condominio ON zona.id_condominio = condominio.id_condominio 
                  Inner Join categoria_incidente ON categoria_incidente.id_categoria_incidente = incidente.id_categoria_incidente WHERE id_incidente='$valor'";
          $result=mysqli_query($conn,$sql);
          $row=mysqli_fetch_array($result);
        ?>
        <div class="card w-80 mx-auto" style="margin-top: 20px;" id="myDIV">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-9">
                <h5><?php echo utf8_encode($row['cod_condominio']);?>-<?php echo utf8_encode($row['morada']);?></h5>
              </div>
              <div class="col-sm-3">
                <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" name="data_incidente" value="<?php echo "Data: ".$row['data_incidente'] ?>" disabled>
              </div>
            </div>    
          </div>
          <div class="card-body">
              <input type="hidden" name="id_incidente" value="<?php echo $valor ?>">
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label>Descrição:</label>
                  <textarea class="form-control" name="descricao" rows="2" disabled>Tipo de avaria: <?php echo utf8_encode($row['categoria_incidente']);?> Descrição do cliente: <?php echo utf8_encode($row['descricao']);?> </textarea>
                </div>
                <div class="form-group col-sm-6">
                  <label>Observações:</label>
                  <textarea class="form-control" name="observacao" rows="2"></textarea>
                </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Tipo manutenção:</label>
                    <select name="id_tipo_manutencao" class="form-control tipo_manutencao" required>
                      <option selected=""></option>
                        <?php
                        $query_1="SELECT id_tipo_manutencao, descricao FROM tipo_manutencao ORDER BY descricao ASC";
                        $result = mysqli_query($conn, $query_1);
                        while($row_result=mysqli_fetch_assoc($result)){ ?>
                      <option value="<?php echo $row_result['id_tipo_manutencao']; ?>"><?php echo utf8_encode($row_result['descricao']); ?></option> <?php
                        }
                            ?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="prioridade" required>Prioridade:</label>
                    <select name="prioridade" class="form-control prioridade" required>
                        <option value=""></option>
                        <option style="background: #009933; color: #fff;">Baixa</option>
                        <option style="background: #e65c00; color: #fff;">Média</option>
                        <option style="background: #cc2900; color: #fff;">Alta</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="data_agendamento">Data agendamento:</label>
                    <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" name="data_agendamento" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Equipa de manutenção:</label>
                    <select name="equipa" class="form-control equipa" required>
                      <option value="">Selecione uma equipa:</option>
                        <?php
                        $query_1="SELECT id_fornecedor, nome FROM fornecedor ORDER BY nome ASC";
                        $result = mysqli_query($conn, $query_1);
                        while($row_result=mysqli_fetch_assoc($result)){ ?>
                      <option value="<?php echo $row_result['id_fornecedor']; ?>"><?php echo utf8_encode($row_result['nome']); ?></option> <?php
                      }
                      ?>
                    </select>
                </div>
              </div>
          </div>
        </div>
        <?php }?>
          <div class="container">
            <input type="submit" value="Submit" name="submit">
          </div>
      </form>
    </div>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="../../js/datepicker.min.js"></script>
    <script src="../../js/i18n/datepicker.pt.js"></script>
    <script src="../../js/fill_form.js"></script>




</body>