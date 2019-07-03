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
            setcookie("tipo_ficheiro_errado", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
            header('Location: /ProjetoFinal/scenes/admin/admin_documentos.php');
            $uploadOk = 0;
        }elseif ($size > 500000) { 
            $uploadOk = 0;
            setcookie("tamanho_ficheiro", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
            header('Location: /ProjetoFinal/scenes/admin/admin_documentos.php');
        }elseif (file_exists($target_file)) {
            echo "Desculpe, o ficheiro que tentou inserir já existe.";
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php  
            $uploadOk = 0;
        }elseif ($uploadOk == 0) {
            echo "Ocorreu um erro, o ficheiro não foi adicionado.";
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
        // se tudo tiver ok faz upload
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

                echo "O ficheiro ". $fileName. " foi adicionado.";
                header('Location: admin_documentos.php');
            } else {
?>      
      <button class="btn btn-secondary" onclick="history.go(-2);"><i class="fa fa-chevron-left"></i> Voltar</button>
<?php 
                echo "Ocorreu um erro, o ficheiro não foi adicionado.";
            }
        }
    }

    
    
    mysqli_close($conn);

?>

