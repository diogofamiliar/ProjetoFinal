<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
    include __DIR__.'/../../core/connect.php';
    mysqli_set_charset($conn, "utf8");
 
// ficheiro que pega no formulario do adicionar_documento.php e insere os dados do form na tabela da bd

    if (isset ($_POST['tipo_documento'], $_POST['id_zona'], $_POST['descricao'] )) {
        $tipo_documento = $_POST['tipo_documento'];
        $id_zona = $_POST['id_zona'];
        $descricao = $_POST['descricao'];
        $size=$_FILES['documento']['size'];
        
    }

    if(isset($_POST['submit'])) {
        //upload file
        $target_dir = "C:/xampp/htdocs/ProjetoFinal/uploads/documentos/";
        $fileName = basename($_FILES['documento']['name']);
        $target_file = $target_dir . $fileName;
        $uploadOk = 1;
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Allow certain file formats
        if($FileType != "pdf" && $FileType != "docx" && $FileType != "doc" ) {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
            echo "Sorry, only PDF, DOC and DOCX files are allowed.";
            $uploadOk = 0;
        }elseif ($size > 500000) {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php   
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }elseif (file_exists($target_file)) {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php  
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }elseif ($uploadOk == 0) {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['documento']['tmp_name'], $target_file)) {

                $id_utilizador=$_SESSION['id_utilizador'];
                $sql = "INSERT INTO documento (nome, descricao, tipo_de_documento, tamanho_ficheiro, id_zona) VALUES ('$fileName', '$descricao', '$tipo_documento', '$size', '$id_zona')";
                if (mysqli_query($conn, $sql)) {
                    $lastid = mysqli_insert_id($conn);
                    $sql1 = "INSERT INTO utilizador_documento (id_utilizador, id_documento, data_criacao) VALUES ('$id_utilizador','$lastid',NOW())";
                    if (mysqli_query($conn, $sql1)) {
                       
                    } else {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
                        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                    }
                } else {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                echo "The file ". $fileName. " has been uploaded.";
                header('Location: admin_documentos.php');
            } else {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    
    
    mysqli_close($conn);

?>

