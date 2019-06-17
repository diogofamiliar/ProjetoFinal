
<?php
session_start();
if(isset($_SESSION['nome_grupo'])=='admin' || isset($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>
<?php
include "../../../core/connect.php";
mysqli_set_charset($conn, "utf8");

if (isset($_POST['id_manutencao'], $_POST['equipa'], $_POST['id_tipo_manutencao'], $_POST['prioridade'], $_POST['data_agendamento'])) {
    $id_manutencao=$_POST['id_manutencao'];
    $equipa=$_POST['equipa'];
    $id_tipo_manutencao=$_POST['id_tipo_manutencao'];
    $prioridade=$_POST['prioridade'];
    $data_agendamento=$_POST['data_agendamento'];
    if (isset($_POST['descricao'])) {
        $descricao=$_POST['descricao'];
        $sql="UPDATE manutencao SET id_fornecedor='$equipa', id_tipo_manutencao='$id_tipo_manutencao', prioridade='$prioridade', data_planeada='$data_agendamento', observacoes='$descricao' WHERE id_manutencao='$id_manutencao'";
        mysqli_query($conn,$sql);
    } else {
        $sql="UPDATE manutencao SET id_fornecedor='$equipa', id_tipo_manutencao='$id_tipo_manutencao', prioridade='$prioridade', data_planeada='$data_agendamento' WHERE id_manutencao='$id_manutencao'";
        mysqli_query($conn,$sql);
    }
    setcookie("manutencao_alterada", "1", time()+(3), "/"); // o "/" disponibiliza a cookie para toda a plataforma
    header('Location: listagem.php');

} else {header('Location: gestao_condominios.php');}


?>
