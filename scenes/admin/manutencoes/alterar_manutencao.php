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
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/custom.css">
    <!-- datepicker CSS-->
    <link href="../../../css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>


    <title>elVecino | Alterar Manutenções</title>
  </head>

<body>

	<?php
  include "../../../core/connect.php";
	include __DIR__.'/../../../headers/admin_header.php';
	?>
  
    <h1 id="h1-centered">Alterar manutenção:</h1>
    <div class="container">
        <?php
        $id_manutencao=$_POST['id_manutencao'];
        echo $id_manutencao;
                $sql="SELECT manutencao.id_manutencao as id_manutencao, manutencao.id_fornecedor as id_fornecedor, fornecedor.nome as fornecedor, zona.morada as morada, zona.nome as entrada, manutencao.data_planeada as data_planeada, incidente.local as local, manutencao.observacoes as observacoes, manutencao.id_tipo_manutencao as id_tipo_manutencao, tipo_manutencao.descricao as tipo_manutencao, incidente_manutencao.estado as estado, zona.id_zona, condominio.cod_condominio as cod_condominio  FROM manutencao
                INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                INNER JOIN zona ON zona.id_zona=incidente.id_zona
                INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio
                INNER JOIN tipo_manutencao ON tipo_manutencao.id_tipo_manutencao=manutencao.id_tipo_manutencao
                INNER JOIN fornecedor ON fornecedor.id_fornecedor=manutencao.id_fornecedor
                WHERE manutencao.id_manutencao='$id_manutencao'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-9">
                            <h5><?php echo utf8_encode($row['cod_condominio']);?> - <?php echo utf8_encode($row['morada']);?> - <?php echo utf8_encode($row['entrada']);?></h5>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form action="alterar_manutencao_1.php" method="POST">
                        <input type="hidden" name="id_manutencao" value="<?php echo $id_manutencao;?>">
                        <div class="form-group">
                            <label>Descrição:</label>
                            <textarea class="form-control" name="descricao" rows="3"><?php echo utf8_encode($row['observacoes']);?></textarea>
                        </div>              
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Tipo manutenção:</label>
                                <select name="id_tipo_manutencao" class="form-control" required>
                                    <option value="<?php echo utf8_encode($row['id_tipo_manutencao']);?>" selected><?php echo utf8_encode($row['tipo_manutencao']);?></option>
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
                                <select name="prioridade" class="form-control" required>
                                    <option value=""></option>
                                    <option style="background: #009933; color: #fff;">Baixa</option>
                                    <option style="background: #e65c00; color: #fff;">Média</option>
                                    <option style="background: #cc2900; color: #fff;">Alta</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="data_agendamento">Data agendamento:</label>
                                <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" name="data_agendamento" id="data_agendamento" value="<?php echo $row['data_planeada'] ?>" placeholder="<?php echo $row['data_planeada'] ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Equipa de manutenção:</label>
                                <select name="equipa" class="form-control" required>
                                <option value="<?php echo utf8_encode($row['id_fornecedor']); ?>" selected><?php echo utf8_encode($row['fornecedor']); ?></option>
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
                        <input type="submit" value="Submit" name="submit">
                    </form>
                </div>
            </div>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="../../../js/datepicker.min.js"></script>
    <script src="../../../js/i18n/datepicker.pt.js"></script>

</body>
</html>