<?php  
 $connect = mysqli_connect("127.0.0.1", "root", "#Qwerty3", "elvecino");  
 if(isset($_POST["query"]))  
 {
      $output = '';  
      $query = "SELECT zona.id_zona AS id_zona, condominio.cod_condominio AS cod_condominio, condominio.nome AS nome, zona.nome As entrada FROM condominio INNER JOIN zona WHERE condominio.nome LIKE '%".$_POST["query"]."%' order by condominio.cod_condominio";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-group">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  <li class="list-group-item">'.$row["id_zona"].'-'.$row["cod_condominio"].'-'.$row["nome"].' - '.$row["entrada"].'</li>';
           }  
      }  
      else  
      {  
           $output .= '<li class="list-group-item">Condomínio nao encontrado</li>';
      }  
      $output .= '</ul>';  
      echo utf8_encode($output);  //IMPORTANTE. ERRO DOS ACENTOS
 }  
 ?>  