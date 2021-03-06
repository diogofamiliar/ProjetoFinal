<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
include __DIR__.'/../../headers/admin_header.php';
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
        <link rel="shortcut icon" type="image/x-icon" href="https://i.imgur.com/SzFkxr6.png" />
        <!-- Sweet alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <title>elVecino | Adicionar Documento</title> 
        <?php include "../../core/connect.php";?>

    </head>

    <body>
       
        <div class="container">
            <h2>Adicionar Documento</h2>
            <form action="inserir_documento.php" method="Post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tipo_documento" class="font-weight-bold">Tipo de documento:</label>
                    <br>
                    <select class="form-control" name="tipo_documento">
                        <option value="Ata de Reuniao">Ata de Reunião</option>
                        <option value="Fatura">Fatura</option>
                        <option value="Seguro">Seguro</option>
                        <option value="Inspecoes">Inspeções</option>
                        <option value="Manutencoes">Manutenções</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="form-group">
                        <label for="id_zona" class="font-weight-bold">Selecione a zona (condominio - zona):</label>
                        <select class="form-control" id="id_zona" name="id_zona" Required>
                            <option value=""></option>
                            <?php
                            $query="SELECT id_zona, zona.nome as nome_zona, condominio.nome as nome_condominio FROM zona INNER JOIN condominio ON zona.id_condominio=condominio.id_condominio";
                            $result = mysqli_query($conn, $query);
                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo $row_result['id_zona']; ?>"><?php echo utf8_encode($row_result['nome_condominio']); ?> - <?php echo utf8_encode($row_result['nome_zona']); ?></option> <?php
                            }
                                ?>
                        </select>
                </div>
                <div class="form-group">
                    <label for="descricao" class="font-weight-bold">Descrição:</label>
                    <textarea class="form-control" rows="3" id="descricao" name="descricao"></textarea>
                </div>
                <div class="form-group">
                    <label for="documento" class="font-weight-bold">Introduza o documento (doc, docx ou pdf):</label><br>
                    <input id="documento" type="file" name="documento" required='required'>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
            </form>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <!-- Optional JavaScript -->
        <script src="../../js/others_show_box.js"></script>
    </body>

</html>
<?php
  if(isset($_COOKIE["tipo_ficheiro_errado"])){
?>
      <script>
      swal({
            title: "ERRO!",
            text: "Desculpe, apenas são permitidos ficheiros do tipo pdf, doc e docx!",
            icon: "error",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

<?php
  if(isset($_COOKIE["tamanho_ficheiro"])){
?>
      <script>
      swal({
            title: "ERRO!",
            text: "Desculpe, o ficheiro que inseriu é muito grande!",
            icon: "error",
            button: "Continuar",
      });
      </script>
<?php
  }
?>

<?php
  if(isset($_COOKIE["ficheiro_existe"])){
?>
      <script>
      swal({
            title: "ERRO!",
            text: "Desculpe, o ficheiro que tentou inserir já existe!",
            icon: "error",
            button: "Continuar",
      });
      </script>
<?php
  }
?>
