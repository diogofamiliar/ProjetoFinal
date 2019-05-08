<?php

if(isset($_POST['submit'])){

    // File upload configuration
    $targetDir = "C:/xampp/htdocs/elVecino/projeto_elVecino/uploads/";
    $allowTypes = array('jpg','png','jpeg','gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "('".$fileName."', NOW()),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }
        
        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database
            $insert = $conn->query("INSERT INTO foto (nome_ficheiro, data_upload) VALUES $insertValuesSQL");
            $first_id_foto = $conn->insert_id; //first id_foto inserted
            echo "\DEPOIS last_id_foto-> $first_id_foto";
            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }
    $sql = "SELECT MAX(id_foto) AS id_foto FROM foto"; //calcular o ultimo id_foto inserido
    $result = $conn->query($sql);//NOT A STRING
    $max_id = mysqli_fetch_array($result, MYSQLI_ASSOC);
    for ($id_foto = $first_id_foto; $id_foto <= $max_id['id_foto']; $id_foto++) {
        $sql = "INSERT INTO ocorrencia_fotos (id_ocorrencia,id_foto) VALUES ('$last_id_ocorrencia', '$id_foto')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
    } 
    // Display status message
    echo $statusMsg;
}
?>