<?php
include '../../headers/admin_header.php';/*
if(isset($_SESSION['nome_grupo'])=='inquilino' && isset($_SESSION['id_utilizador'])){
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

        <title>Àrea administrativa</title> 
        <?php include "../../core/connect.php";?>

    </head>

    <body>
        <div class="container">
            <h2 id="h1-centered">Registo de Incidente</h2>
            <form action="inserir_incidente.php" method="Post" enctype="multipart/form-data">    
                <div class="form-group">
                    <label for="morada" class="font-weight-bold">Insira a morada:</label>
                    <input type="text" name="id_zona" id="id_condominio" class="form-control" placeholder="Selecione uma das opções"/ Required>  
                    <div id="lista_condominios"></div> 
                </div>
                <div class="form-group">
                    <label for="localizacao" class="font-weight-bold">Insira o local do incidente:</label>
                    <input type="text" class="form-control" placeholder="Rés chão, garagem, 2º piso" name="local" Required>
                </div>
                <div class="form-group form-row">
                    <div class="form-group col-md-6">
                        <label for="id_categoria_incidente" class="font-weight-bold">Selecione o tipo de incidente:</label>
                        <select class="form-control" id="id_categoria_incidente" name="id_categoria_incidente" Required>
                            <option value=""></option>
                            <?php
                            $query="SELECT id_categoria_incidente,descricao FROM categoria_incidente";
                            $result = mysqli_query($conn, $query);
                            while($row_result=mysqli_fetch_assoc($result)){ ?>
                                <option value="<?php echo $row_result['id_categoria_incidente']; ?>"><?php echo $row_result['descricao']; ?></option> <?php
                            }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descricao" class="font-weight-bold">Descrição:</label>
                    <textarea class="form-control" rows="3" id="descricao" name="descricao"></textarea>
                </div>
                <div class="form-group">
                    <label for="camera" class="font-weight-bold">Introduza imagens:</label>
                    <input id="camera" type="file" accept="image/*" capture="camera" name="files[]" multiple>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../../js/jquery-3.4.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <!-- Optional JavaScript -->
        <script src="../../js/others_show_box.js"></script>
        <!-- LIVE SEARCH BAR JavaScript -->
        <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){  
            $('#id_condominio').keyup(function(){
                var query = $(this).val();  
                if(query != '')  
                {  
                    $.ajax({  
                        url:"../zona_fetch.php",
                        method:"POST",  
                        data:{query:query},  
                        success:function(data)  
                        {  
                                $('#lista_condominios').fadeIn();  
                                $('#lista_condominios').html(data);  
                        }  
                    });  
                }  
            });  
            $(document).on('click', 'li', function(){  
                $('#id_condominio').val($(this).text());  
                $('#lista_condominios').fadeOut();  
            });  
            
        }); 
        </script>
    </body>

</html>