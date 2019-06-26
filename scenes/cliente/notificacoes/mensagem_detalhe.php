<?php
session_start();
if(($_SESSION['nome_grupo'])=='cliente' || ($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
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
        <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
    <title>Mensagens</title>
    </head>

<body>

<?php
    
    include '../../../core/notificacao.php';
    include __DIR__.'/../../../headers/cliente_header.php';
    include '../../../core/connect.php';
    if(isset($_POST['mensagem'])){
        $mensagem=$_POST['mensagem'];
        $sql = "UPDATE destinatario SET lida='1', data_leitura=now() WHERE id_mensagem=$mensagem";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        $sql = "SELECT mensagem.id_mensagem as id_mensagem, mensagem.assunto as assunto, mensagem.texto as mensagem, mensagem.data_criacao as data_criacao FROM mensagem WHERE mensagem.id_mensagem='$mensagem'";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        $row = mysqli_fetch_assoc($resultset);
    }
?>
  
    <h1 id="h1-centered">Aviso:</h1>
    <div class="container d-flex justify-content-center">
        <div class="card col-sm-8">
            <div class="card-header">
                <div class="row">
                    <div class="form-group col-sm-8">
                        <h5>Assunto:</h5>
                        <h6><?php echo utf8_encode($row['assunto']);?></h6>
                    </div>
                    <div class="form-group col-sm-4">
                        <h5>Data:</h5>
                        <input type="text" class="datepicker-here form-control" data-language='pt'data-position="bottom right" value="<?php echo $row['data_criacao'] ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Mensagem:</label>
                    <textarea class="form-control" name="texto" rows="10" disabled><?php echo utf8_encode($row['mensagem']);?></textarea>
                </div>
            <button class="btn btn-secondary" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i> Voltar</button>
            </div>
        </div>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>
