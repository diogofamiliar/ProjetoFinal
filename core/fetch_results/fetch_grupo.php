<?php  
 $connect = mysqli_connect("127.0.0.1", "root", "#Qwerty3", "elvecino");  
 if(isset($_POST["query"]))  
 {
      $output = '';  
      $query = "SELECT id_grupo, nome FROM grupo WHERE grupo.nome!='admin' AND grupo.nome!='master' AND grupo.nome!='tecnico' AND nome LIKE '%".$_POST["query"]."%'";  
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
           $output .= '<li class="list-group-item">Grupo nao encontrado</li>';  
      }  
      $output .= '</ul>';  
      echo utf8_encode($output);  //IMPORTANTE. ERRO DOS ACENTOS
 }  
 ?>  