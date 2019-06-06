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

    <title>elVecino | Mensagens</title>
  </head>

<body>

	<?php
  include "../../core/connect.php";
	include __DIR__.'/../../headers/admin_header.php';
	?>
  
    <h1 id="h1-centered">Criar mensagem:</h1>
    <div class="container">
    <form method="POST" action="enviar_mensagem.php">
        <div class="form-row">
            <label for="destinatario" class="col-sm-2 col-form-label">Enviar para:</label>
            <select name="tipo_destinatario" id="tipo_destinatario" class="form-control col-sm-3" onclick="showTipoDestinatario()">
              <option value="">Tipo destinatário</option>
              <option value="id_utilizador">Utilizador</option>
              <option value="id_condominio">Condomínio</option>
              <option value="id_grupo">Grupo de Utilizadores</option>  
            </select>
        </div>
        <div class="form-row" id="utilizador" style="display: none;">
          <label for="utilizador" class="col-sm-2 col-form-label">Nome do utilizador:</label>
          <input type="text" name="input_utilizador" id="id_utilizador" class="form-control" placeholder="Selecione uma das opções" onfocus="this.value=''" required>  
          <div id="lista_utilizadores"></div> 
        </div>
        <div class="form-row" id="condominio" style="display: none;">
            <label for="condominio" class="col-sm-2 col-form-label">Condomínio:</label>
            <input type="text" name="input_condominio" id="id_condominio" class="form-control" placeholder="Selecione uma das opções" onfocus="this.value=''" required>  
            <div id="lista_condominios"></div> 
        </div>
        <div class="form-row" id="grupo" style="display: none;">
            <label for="grupo" class="col-sm-2 col-form-label">Grupo:</label>
            <input type="text" name="input_grupo" id="id_grupo" class="form-control" placeholder="Selecione uma das opções" onfocus="this.value=''" required>  
            <div id="lista_grupos"></div> 
        </div>
        <div class="form-group" id="assunto" style="display: none;">
            <label>Assunto</label>
            <input type="text" name="assunto" class="form-control">
        </div>
        <div class="form-group" id="mensagem" style="display: none;">
            <label>Inserir mensagem</label>
            <textarea name="mensagem" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary">Enviar</button>
    </form>
    </div>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="../../js/jquery-3.4.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- LIVE SEARCH BAR JavaScript -->
    <script type="text/javascript" src="../../js/search/search_user.js" charset="utf-8"></script>
    <script type="text/javascript" src="../../js/search/search_condominio.js" charset="utf-8"></script>
    <script type="text/javascript" src="../../js/search/search_grupo.js" charset="utf-8"></script>
    <!-- Opções de vizualização -->

    <!-- Optional JavaScript -->
    <script src="../../js/datepicker.min.js"></script>
    <script src="../../js/i18n/datepicker.pt.js"></script>
    <script>
      function showTipoDestinatario() {
        document.getElementsByName("input_utilizador")[0].value = "" ;
        document.getElementsByName("input_grupo")[0].value = "" ;
        document.getElementsByName("input_condominio")[0].value = "" ;

        var tipo_destinatario = jQuery('#tipo_destinatario');
        tipo_destinatario.change(function () {
            if ($(this).val() == 'id_utilizador') {
              $('#utilizador').show();
              $('#condominio').hide();
              $('#grupo').hide();
              $('#assunto').show();
              $('#mensagem').show();
            }else if ($(this).val() == 'id_condominio') {
              $('#utilizador').hide();
              $('#condominio').show();
              $('#grupo').hide();
              $('#assunto').show();
              $('#mensagem').show();
            }else if ($(this).val() == 'id_grupo') {
              $('#utilizador').hide();
              $('#condominio').hide();
              $('#grupo').show();
              $('#assunto').show();
              $('#mensagem').show();
            }else if ($(this).val() == '') {
              $('#utilizador').hide();
              $('#condominio').hide();
              $('#grupo').hide();
              $('#assunto').hide();
              $('#mensagem').hide();
            }
        });
      }
    </script>

</body>