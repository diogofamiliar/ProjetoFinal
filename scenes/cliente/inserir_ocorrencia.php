<?php
include "C:/xampp/htdocs/elVecino/projeto_elVecino/core/connect.php";
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


$sql = "INSERT INTO ocorrencia (local_ocorrencia,id_tipoocorrencia,outro_tipo_ocorrencia,descricao,data_ocorrencia) VALUES ('$local_ocorrencia','$id_tipoocorrencia','$outro_tipo_ocorrencia','$descricao',now())";
if (mysqli_query($conn, $sql)) {
    $last_id_ocorrencia = $conn->insert_id;
    echo "last_id_ocorrencia-> $last_id_ocorrencia;";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//upload das fotos
include "C:/xampp/htdocs/elVecino/projeto_elVecino/upload.php";

mysqli_close($conn);
?>