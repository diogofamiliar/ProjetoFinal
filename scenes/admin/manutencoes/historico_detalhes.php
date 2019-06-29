<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
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
    <!-- datepicker CSS-->
    <link href="../../../css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Alterar Manutenções</title>
  </head>

<body>

	<?php
  include "../../../core/connect.php";
	include __DIR__.'/../../../headers/admin_header.php';
	?>
  
    <h1 id="h1-centered"> Detalhes reparação:</h1>
    <div class="container my-5">
        <?php
        $id_manutencao=$_POST['id_manutencao'];
                $sql="SELECT manutencao.id_manutencao as id_manutencao, 
                manutencao.id_fornecedor as id_fornecedor, 
                fornecedor.nome as fornecedor, 
                zona.morada as morada, 
                zona.nome as entrada, 
                manutencao.data_planeada as data_planeada, 
                manutencao.data_conclusao as data_reparacao, 
                incidente.local as local, 
                incidente.descricao as descricao, 
                incidente.data_incidente as data_incidente, 
                manutencao.observacoes as observacoes, 
                manutencao.id_tipo_manutencao as id_tipo_manutencao, 
                tipo_manutencao.descricao as tipo_manutencao, 
                incidente_manutencao.estado as estado, 
                zona.id_zona, condominio.cod_condominio as cod_condominio, 
                utilizador.id_utilizador as utilizador, 
                utilizador.nome as cliente
                FROM manutencao
                            INNER JOIN incidente_manutencao ON manutencao.id_manutencao=incidente_manutencao.id_manutencao
                            INNER JOIN incidente ON incidente.id_incidente=incidente_manutencao.id_incidente
                            INNER JOIN zona ON zona.id_zona=incidente.id_zona
                            INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio
                            INNER JOIN tipo_manutencao ON tipo_manutencao.id_tipo_manutencao=manutencao.id_tipo_manutencao
                            INNER JOIN fornecedor ON fornecedor.id_fornecedor=manutencao.id_fornecedor
                            INNER JOIN utilizador ON utilizador.id_utilizador=incidente.id_utilizador
                WHERE manutencao.id_manutencao='$id_manutencao'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_array($result);
        ?>
            <div class="card" style="margin-top: 20px;" id="myDIV">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?php echo utf8_encode($row['cod_condominio']);?> - <?php echo utf8_encode($row['morada']);?> - <?php echo utf8_encode($row['entrada']);?></h4>
                        </div>
                    </div>    
                </div>
                <div class="card-header">
                    <h5>Registo da reparação:</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6 form-group">
                            <label class="col-sm-5" for="equipa">Fornecedor:</label>
                            <input class="col-sm-6" type="text" readonly id="equipa" value="<?php echo utf8_encode($row['fornecedor']);?>">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="col-sm-5" for="equipa">Local:</label>
                            <input class="col-sm-6" type="text" readonly id="equipa" value="<?php echo utf8_encode($row['local']);?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 form-group">
                            <label class="col-sm-5" for="equipa">Data agendamento:</label>
                            <input class="col-sm-6" type="text" readonly id="equipa" value="<?php echo utf8_encode($row['data_planeada']);?>">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="col-sm-5" for="equipa">Data reparação:</label>
                            <input class="col-sm-6" type="text" readonly id="equipa" value="<?php echo utf8_encode($row['data_reparacao']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-2 col-form-label">Descrição:</label>
                            <textarea class="form-control" readonly name="descricao" rows="3"><?php echo utf8_encode($row['observacoes']);?></textarea>
                    </div> 
                </div>
                <div class="card-header">
                    <h5>Registo do Incidente:</h5>        
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6 form-group-row">
                            <label class="col-sm-5" for="equipa">Utilizador:</label>
                            <input class="col-sm-6" type="text" readonly id="equipa" value="<?php echo utf8_encode($row['cliente']);?>">
                        </div>
                        <div class="col-sm-6 form-group-row">
                            <label class="col-sm-5" for="equipa">Data incidente:</label>
                            <input class="col-sm-6" type="text" readonly id="equipa" value="<?php echo utf8_encode($row['data_incidente']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descrição:</label>
                        <textarea class="form-control" readonly name="descricao" rows="3"><?php echo utf8_encode($row['descricao']);?></textarea>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <H6>Fotografias do incidente</H6> <!-- COLOCAR A APARECER ESTA SEÇÃO SÓ SE HOUVER FOTOS. OU CASO DE NAO HAVER FOTOS, EMITIR ESSA MENSAGEM -->
                        </div>
                        <div class="card-body">
                            <H1>FOTOS AQUI</H1>
                        </div>

                    </div>
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