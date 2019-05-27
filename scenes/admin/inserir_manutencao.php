
<?php /*
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
    
}else header('Location: ../../index.php');
*/

if (isset ($_POST['id_incidente'])) {
    $id_incidente=$_POST['id_incidente'];
    
}else echo "nada"; //mudar ISTO . REENCAMINHAR PARA OUTRO LADO

?>

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

    <title>elVecino | Inserir Manutenções</title>
  </head>

<body>

	<?php
  include "../../core/connect.php";
	include __DIR__.'/../../headers/admin_header.php';
	?>
  
    <h1 id="h1-centered">Inserir manutenções:</h1>
    <div class="container">
        <?php
            foreach ($id_incidente as $valor) {
                $sql="  SELECT incidente.data_incidente AS data_incidente, incidente.local as local, categoria_incidente.descricao as categoria_incidente, zona.nome AS entrada, incidente.descricao AS descricao, condominio.cod_condominio AS cod_condominio, condominio.morada AS morada
                            FROM incidente 
                            inner JOIN zona ON incidente.id_zona = zona.id_zona 
                            Inner JOIN condominio ON zona.id_condominio = condominio.id_condominio 
                            Inner Join categoria_incidente ON categoria_incidente.id_categoria_incidente = incidente.id_categoria_incidente WHERE id_incidente='$valor'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-9">
                            <h5><?php echo utf8_encode($row['cod_condominio']);?>-<?php echo utf8_encode($row['morada']);?></h5>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" name="data_nascimento" value="<?php echo $row['data_incidente'] ?>" disabled>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Descrição:</label>
                            <textarea class="form-control" id="descricao" rows="2" disabled>Tipo de avaria: <?php echo utf8_encode($row['categoria_incidente']);?> Descrição do cliente: <?php echo utf8_encode($row['descricao']);?> </textarea>
                        </div>              
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Tipo manutenção:</label>
                                <select id="tipo_manutencao" class="form-control">
                                    <option selected="">Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="prioridade">Prioridade</label>
                                <select id="prioridade" class="form-control">
                                    <option selected="2" style="background: #0ca027; color: #fff;">Baixa</option>
                                    <option style="background: #e65c00; color: #fff;">Média</option>
                                    <option style="background: #cc2900; color: #fff;">Alta</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="data_agendamento">Data agendamento:</label>
                                <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" name="data_agendamento" id="data_agendamento" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Equipa de manutenção:</label>
                                <select id="equipa" class="form-control">
                                <option value=""></option>
                                    <?php
                                    $query_1="SELECT id_fornecedor, nome FROM fornecedor";
                                    $result = mysqli_query($conn, $query_1);
                                    while($row_result=mysqli_fetch_assoc($result)){ ?>
                                        <option value="<?php echo $row_result['id_fornecedor']; ?>"><?php echo $row_result['nome']; ?></option> <?php
                                    }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submit_form();">Submeter</button>
                    </form>
                </div>
            </div>
        <?php }?>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="../../js/datepicker.min.js"></script>
    <script src="../../js/i18n/datepicker.pt.js"></script>


	
<script>
function submit_form(){
var prioridade=$("#prioridade").val();
var data_agendamento=$("#data_agendamento").val();
var dataTosend='prioridade='+prioridade+'&data_agendamento='+data_agendamento;
    $.ajax({
    url: 'manutencao_handle.php',
    type: 'POST',
    data:{prioridade: "média"},
    async: true,
    success: function (data) {
    alert(data)
    },
    });
}
</script>
    

</body>