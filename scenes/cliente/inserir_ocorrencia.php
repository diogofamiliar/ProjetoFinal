<?php 
session_start();
if(isset($_SESSION['nome_grupo'])=='inquilino' || isset($_SESSION['nome_grupo'])=='cliente' && isset($_SESSION['id_utilizador'])){
}else header('Location: ../../index.php');

include __DIR__.'/../../core/connect.php';
mysqli_set_charset($conn, "utf8");

/*
ficheiro que pega no formulario do registo_incidente.php e insere os dados do form na tabela "ocorrencia da bd"
*/
if (isset ($_POST['local'], $_POST['id_categoria_incidente'])) {
    $local = $_POST['local'];
    $id_categoria_incidente = $_POST['id_categoria_incidente'];
}

if (isset ($_POST['descricao'])) {
    $descricao = $_POST['descricao'];
    echo $descricao;
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


$sql = "INSERT INTO incidente (id_utilizador,id_zona,local,id_categoria_incidente,descricao,data_incidente) VALUES ('$id_utilizador','$id_zona','$local','$id_categoria_incidente','$descricao',now())";
if (mysqli_query($conn, $sql)) {
    $last_id_incidente = $conn->insert_id;
    //echo "last_id_incidente-> $last_id_incidente;";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//upload das fotos
    include '../../upload.php';


mysqli_close($conn);
setcookie("registo_efetuado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
header('location: cliente.php', true);   
?>