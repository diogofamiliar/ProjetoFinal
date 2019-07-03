<?php  
 $connect = mysqli_connect("127.0.0.1", "root", "#Qwerty3", "elvecino");  
 if(isset($_POST["query"]))  
 {
      $output = '';  
      $query = "SELECT utilizador.id_utilizador as id_utilizador, utilizador.nome as nome, utilizador_grupo.id_grupo, grupo.nome as grupo_nome
               FROM utilizador
               INNER JOIN utilizador_grupo ON utilizador_grupo.id_utilizador=utilizador.id_utilizador
               INNER JOIN grupo ON grupo.id_grupo=utilizador_grupo.id_grupo
               WHERE grupo.nome!='admin' AND grupo.nome!='master' AND grupo.nome!='tecnico' AND utilizador.nome LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-group">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  <li class="list-group-item">'.$row["nome"].'</li>';
           }  
      }  
      else  
      {  
           $output .= '<li class="list-group-item">Utilizador nao encontrado</li>';  
      }  
      $output .= '</ul>';  
      echo utf8_encode($output);  //IMPORTANTE. ERRO DOS ACENTOS
 }  
 ?>  