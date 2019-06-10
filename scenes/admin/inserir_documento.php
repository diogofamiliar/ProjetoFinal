<?php
    session_start();
    if(isset($_SESSION['nome_grupo'])=='admin' && isset($_SESSION['id_utilizador'])){
    }else header('Location: ../../index.php');

    include __DIR__.'/../../core/connect.php';

// ficheiro que pega no formulario do adicionar_documento.php e insere os dados do form na tabela da bd

    if (isset ($_POST['tipo_documento'], $_POST['id_zona'], $_POST['nome'], $_POST['descricao'] )) {
        $tipo_documento = $_POST['tipo_documento'];
        $id_zona = $_POST['id_zona'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        //só funciona para docx e doc, pdf nao
        $size=$_FILES['documento']['size'];
        
    }

    if(isset($_POST['submit'])) {
        //upload file
        $target_dir = "C:/xampp/htdocs/ProjetoFinal/uploads/";
        $fileName = basename($_FILES['documento']['name']);
        $target_file = $target_dir . $fileName;
        $uploadOk = 1;
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Allow certain file formats
        if($FileType != "pdf" && $FileType != "docx" && $FileType != "doc" ) {
            echo "Sorry, only PDF, DOC and DOCX files are allowed.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }       
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['documento']['tmp_name'], $target_file)) {

                $id_utilizador=$_SESSION['id_utilizador'];
                $sql = "INSERT INTO documento (nome, descricao, tipo_de_documento, tamanho_ficheiro, id_zona) VALUES ('$nome', '$descricao', '$tipo_documento', '$size', '$id_zona')";
               
                if (mysqli_query($conn, $sql)) {
                    $lastid = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO utilizador_documento (id_utilizador, id_documento, data_criacao) VALUES ('$id_utilizador','$lastid',NOW())";
                    if (mysqli_query($conn, $sql1)) {
                       
                    } else {
                        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                echo "The file ". $fileName. " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    
    
    mysqli_close($conn);

?>

