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
    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(function () {

    $('form').on('submit', function (e) {

        e.preventDefault();
        var theForm=$(this);

        $.ajax({
        type: 'post',
        url: 'editar_incidente_handle.php',
        data: $(theForm).serialize(),
        success: function () {
            theForm.hide();
            swal({
                title: "Alterado!",
                text: "O incidente foi alterado com sucesso!",
                icon: "success",
                button: "Continuar",
            });
        }
        });

    });

    });
</script>

        <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
        <title>Editar Manutenções</title>
  </head>

<body>

	<?php
  include "../../../core/connect.php";
	include __DIR__.'/../../../headers/admin_header.php';
	?>
  
    <h1 id="h1-centered">Editar incidentes:</h1>
    <div class="container">
    <button class="btn btn-secondary" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i> Voltar</button>
        <?php
        $id_incidente=$_POST['id_incidente'];
            foreach ($id_incidente as $valor) {
                $sql="SELECT incidente.data_incidente AS data_incidente, incidente.local as local, incidente.id_categoria_incidente as id_categoria_incidente ,categoria_incidente.descricao as categoria_incidente, zona.nome AS entrada, incidente.descricao AS descricao, condominio.cod_condominio AS cod_condominio, condominio.morada AS morada
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
                        <div class="col-sm-12">
                            <h5><?php echo utf8_encode($row['cod_condominio']);?> - <?php echo utf8_encode($row['morada']);?> - <?php echo utf8_encode($row['local']);?></h5>
                        </div>
                    </div>    
                </div>
                <div class="card-body">
                    <form>
                        <input type="hidden" name="id_incidente" value="<?php echo $valor ?>">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Local:</label>
                                <input class="form-control" type="text" name="local" value="<?php echo utf8_encode($row['local']);?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tipo manutenção:</label>
                                <select name="id_categoria_incidente" class="form-control" required>
                                    <option value="<?php echo $row['id_categoria_incidente']; ?>"><?php echo $row['categoria_incidente']; ?></option>
                                    <?php
                                    $query_1="SELECT id_categoria_incidente, descricao FROM categoria_incidente ORDER BY descricao ASC";
                                    $result = mysqli_query($conn, $query_1);
                                    while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo $row_result['id_categoria_incidente']; ?>"><?php echo utf8_encode($row_result['descricao']); ?></option> <?php
                                    }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="data_agendamento">Data incidente:</label>
                                <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" name="data_incidente" id="data_incidente" value="<?php echo $row['data_incidente'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descrição do cliente:</label>
                            <textarea class="form-control" name="descricao" rows="2"><?php echo utf8_encode($row['descricao']);?> </textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input class="btn btn-primary" type="submit" value="Enviar" name="submit">
                        </div>      
                    </form>
                </div>
            </div>
        <?php }?>
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