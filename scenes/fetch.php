<?php  
 $connect = mysqli_connect("127.0.0.1", "root", "#Qwerty3", "elvecino");  
 if(isset($_POST["query"]))  
 {
      $output = '';  
      $query = "SELECT id_condominio, morada FROM condominio WHERE morada LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-group">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  <li class="list-group-item">'.$row["morada"].'</li>
                              <input type="hidden" id="hide" name="hide" value="'.$row["id_condominio"].'"/>';
           }  
      }  
      else  
      {  
           $output .= '<li class="list-group-item">Condomínio nao encontrado</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  