<?php
    //session_start();
    //if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){
    //}else header('Location: ../../index.php');

    include __DIR__.'/../../core/connect.php';

// ficheiro que pega no formulario do adicionar_documento.php e insere os dados do form na tabela da bd

    if (isset ($_POST['tipo_documento'], $_POST['id_zona'], $_POST['nome'], $_POST['descricao'], $_POST['documento'])) {
        $tipo_documento = $_POST['tipo_documento'];
        $id_zona = $_POST['id_zona'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $document = $_POST['documento'];
}
    $id_utilizador=$_SESSION['id_utilizador'];
    $sql = "INSERT INTO documento (nome, descricao, tipo_de_documento, tamanho_ficheiro, id_zona) VALUES ('$nome', '$descricao', '$tipo_documento', ' filesize($documento)', '$id_zona')";
    if (mysqli_query($conn, $sql)) {
        echo "done";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);

?>

