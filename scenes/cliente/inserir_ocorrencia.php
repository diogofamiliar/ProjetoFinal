<?php 
session_start();
if(isset($_SESSION['id_grupo'])=='7' || isset($_SESSION['id_utilizador'])){
  echo "grupo 7 c/ utilizador definido";
}else header('Location: ../../index.php');

include __DIR__.'/../../core/connect.php';

/*
ficheiro que pega no formulario do registo_incidente.php e insere os dados do form na tabela "ocorrencia da bd"
*/
if (isset ($_POST['local_ocorrencia'], $_POST['tipo_incidente'])) {
    $local_ocorrencia = $_POST['local_ocorrencia'];
    $id_tipoocorrencia = $_POST['tipo_incidente'];
}
if (isset ($_POST['other_type'])) {
    $outro_tipo_ocorrencia = $_POST['other_type'];
}

if (isset ($_POST['descricao'])) {
    $descricao = $_POST['descricao'];

}

$id_utilizador=$_SESSION['id_utilizador'];

//seleciona a zona com base no id_utilizador

$sql = "SELECT id_zona FROM utilizador WHERE id_utilizador='$id_utilizador' LIMIT 1";
$result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               $id_zona=$row['id_zona'];
            }
         } else {
            echo "0 results";
         }

echo $id_zona;

$sql = "INSERT INTO ocorrencia (id_utilizador,id_zona,local_ocorrencia,id_tipoocorrencia,outro_tipo_ocorrencia,descricao,data_ocorrencia,estado) VALUES ('$id_utilizador','$id_zona','$local_ocorrencia','$id_tipoocorrencia','$outro_tipo_ocorrencia','$descricao',now(),'3')";
if (mysqli_query($conn, $sql)) {
    $last_id_ocorrencia = $conn->insert_id;
    echo "last_id_ocorrencia-> $last_id_ocorrencia;";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//upload das fotos
    include '../../upload.php';


mysqli_close($conn);

header('location: cliente.php', true);   
?>