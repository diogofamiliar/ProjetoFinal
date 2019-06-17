<?php
include "../../../core/connect.php";

if(isset ($_POST['id_incidente'],$_POST['id_tipo_manutencao'],$_POST['id_incidente'],$_POST['data'],$_POST['equipa']) ){
$id_incidente=$_POST['id_incidente'];$observacao=$_POST['observacao'];$id_tipo_manutencao=$_POST['id_tipo_manutencao'];$data=$_POST['data'];$equipa=$_POST['equipa'];$prioridade=$_POST['prioridade'];
        
//mysql-criar uma lista de tarefas
    $sql = "INSERT INTO lista_tarefas (data_planeada) VALUES (now())";
    if (mysqli_query($conn, $sql)) {
        $last_id_tarefa = $conn->insert_id;
        } else {echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
    $valores = array_map(null, $data, $observacao, $prioridade, $id_tipo_manutencao, $equipa);
    $all_values = [];
    $query = "INSERT INTO manutencao (data_planeada,observacoes,prioridade,id_tipo_manutencao,id_fornecedor) VALUES "; //vai ser usado para inserir as manutenções
    foreach($valores as $key) {
    $row_values = [];
        foreach($key as $s_key => $s_value) {
            $row_values[] = '"'.$s_value.'"';
        }
    $all_values[] = '('.implode(',', $row_values).')';    
        }
    //descobrir o id max da manutencao antes de inserir os novos dados
    $sql="SELECT MAX(manutencao.id_manutencao) AS manu_min FROM manutencao";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $manu_min=$row['manu_min'];
        }
    } else {}
    $query .= implode(',', $all_values);
    //insere os valores $data, $observacao, $prioridade, $id_tipo_manutencao, $equipa na tabela manutencoes como novas manutencoes
    if ($conn->query($query) === TRUE) {
        //inserimos o id_tarefa na tabela
        $sql="UPDATE manutencao SET manutencao.id_lista_tarefas='$last_id_tarefa' WHERE manutencao.id_manutencao>'$manu_min'";
        $conn->query($sql);
        //faz a associação id_incidente à respetiva manutenção (INSERÇÃO DE VALORES NA TABELA INCIDENTE_MANUTENCAO)
        foreach ($id_incidente as $key => $value) {
            $sql="insert into incidente_manutencao (id_incidente,id_manutencao, data_insert, estado) values ('$value','$manu_min', now(),'agendada')";
            $manu_min++;
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

header('Location: selecao_ocorrencias.php');
//CRIAR COOKIE
}
?>