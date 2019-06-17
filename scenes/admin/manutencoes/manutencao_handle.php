<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include "../../../core/connect.php";

    if(isset($_POST['equipa'], $_POST['data_agendamento'], $_POST['observacao'], $_POST['prioridade'], $_POST['id_tipo_manutencao'], $_POST['id_incidente'])){
        $id_tipo_manutencao=$_POST['id_tipo_manutencao'];
        $id_incidente=$_POST['id_incidente'];
        $prioridade=$_POST['prioridade'];
        $data_agendamento=$_POST['data_agendamento'];
        $equipa=$_POST['equipa'];
        $observacao=$_POST['observacao'];
        $sql="INSERT INTO manutencao (data_planeada, observacoes, prioridade, id_tipo_manutencao, id_fornecedor)VALUES ('$data_agendamento','$observacao','$prioridade','$id_tipo_manutencao','$equipa')";
        if ($conn->query($sql) === TRUE) {
                $last_id_manutencao = $conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
            $sql="INSERT INTO incidente_manutencao (id_incidente, id_manutencao, data_insert, estado) VALUES ('$id_incidente', '$last_id_manutencao', now(),'agendada')";
            if ($conn->query($sql) === TRUE) {
                echo "Have a good night!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }else { //caso nao tenha inserido descricao/observacao
        $id_tipo_manutencao=$_POST['id_tipo_manutencao'];
        $prioridade=$_POST['prioridade'];
        $data_agendamento=$_POST['data_agendamento'];
        $equipa=$_POST['equipa'];
        $sql="INSERT INTO manutencao (data_planeada, prioridade, id_tipo_manutencao, id_fornecedor)VALUES ('$data_agendamento','$prioridade','$id_tipo_manutencao','$equipa')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
