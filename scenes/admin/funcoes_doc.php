<?php
session_start();
if(($_SESSION['nome_grupo'])=='admin' || ($_SESSION['nome_grupo'])=='master' && isset($_SESSION['id_utilizador'])){
}else header('Location: /ProjetoFinal/index.php');
?>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../css/custom.css">


<?php
include __DIR__.'/../../core/connect.php';

$id=$_GET["id"];
$tipo=$_GET["tipo"];

if(isset($_GET["apagar"])){
    $apagar=$_GET["apagar"];
}else{
    $apagar=false;
}



if($tipo=="apagar" && $apagar){

				$sql1="DELETE FROM utilizador_documento WHERE id_documento = ".$id;		
                $sql="DELETE FROM documento WHERE documento.id_documento = ".$id;
               
				if(mysqli_query($conn,$sql1)){
                    echo "Registo apagado com sucesso!";
                    if(mysqli_query($conn,$sql)){
                        echo "Registo apagado com sucesso!";
                        header('Location: admin_documentos.php');
                    }else{
                        echo "Ocorreu um erro!";
                    }
				}else{
                    echo "Ocorreu um erro!";
				}
			} elseif($tipo=="apagar"){

?>
			<!-- janela para confirmar se quer apagar-->
			<script language="javascript" type="text/javascript">
							
				var resposta = confirm("Tem a certeza?");

				if(!resposta){
					window.location.replace("admin_documentos.php");
				}else if(resposta){
					window.location.replace("funcoes_doc.php?id=<?php echo $id;?>&tipo=apagar&apagar=true");	
				}
			</script>
            <?php
            }elseif($tipo=="editar"){
                $descricao=$_GET["descricao"];
                $zona=$_GET["zona"];
                $tipo_documento=$_GET["tipo_documento"];

                $query1="SELECT id_zona FROM zona WHERE nome='$zona' ";
                $result = mysqli_query($conn, $query1);
                $rows = mysqli_fetch_assoc($result);

                $query2="SELECT condominio.nome as nome_condominio FROM zona INNER JOIN condominio ON zona.id_condominio=condominio.id_condominio WHERE zona.nome='$zona' ";
                $result1 = mysqli_query($conn, $query2);
                $row = mysqli_fetch_assoc($result1);
?>
                <form  method="GET">
				<!-- formulario para receber os dados para editar -->
				<h1 class="font-weight-bold">Editar</h1>
				<form>
                        <input type="hidden" name="id" required ="required" value='<?php echo $id ?>'>
		    			<label class="font-weight-bold">Tipo de documento:</label>
                        <select class="form-control" name="new_tipo_documento">
			  				<option name="tipo_documento" value="<?php echo $tipo_documento;?>"><?php echo $tipo_documento;?></option>
                            <option value="Ata de Reuniao">Ata de Reunião</option>
                            <option value="Fatura">Fatura</option>
                            <option value="Seguro">Seguro</option>
                            <option value="Inspecoes">Inspeções</option>
                            <option value="Manutencoes">Manutenções</option>
<?php
							$new_tipo_documento=$_GET['new_tipo_documento'];
?>
            			</select>

                        <?php
			$sql="SELECT * FROM zona";
  			$res= $conn->query($sql);
    		if($res->num_rows > 0){
				$linha = $res->fetch_assoc();
				$query_opc = "SELECT id_zona, zona.nome as nome_zona, condominio.nome as nome_condominio FROM zona INNER JOIN condominio ON zona.id_condominio=condominio.id_condominio";
                $opc = $conn->query($query_opc);
              
?>
             <br>
             <label class="font-weight-bold">Selecione a zona (condominio - zona):</label><br><select class="form-control" name="new_zona" id="<?php echo $zona;?>">
				<option name="new_zona" value="<?php echo $rows["id_zona"]; ?>"><?php echo utf8_encode($row["nome_condominio"]) ?> - <?php echo utf8_encode($zona) ?></option>;
<?php
                while($opcao = $opc->fetch_assoc()) {
?>
                  <option name="new_zona" value="<?php echo $opcao['id_zona']?>"><?php echo utf8_encode($opcao['nome_condominio'])?> - <?php echo utf8_encode($opcao['nome_zona'])?></option>
<?php 
}
					$new_zona=$_GET['new_zona'];
}             
?>
                </select><br>

		    				<label class="font-weight-bold">Descrição:</label>
                            <textarea class="form-control" rows="3" type="text" name="new_descricao"  value='<?php echo $descricao;?>'><?php echo $descricao;?></textarea><br>
						

		    			<button type="submit" value ="Editar" class="btn btn-primary">Editar</button>

		    			<button type="button" onclick="history.back();" class="btn btn-primary">Cancelar</button>		
		 		</form> 
<?php
            }
            

            if(isset($_GET["new_tipo_documento"]) && isset($_GET["new_zona"])&& isset($_GET["new_descricao"])){
				$id=$_GET["id"];
                $new_tipo_documento=$_GET["new_tipo_documento"];	
                $new_zona=$_GET["new_zona"];
                $new_descricao=$_GET["new_descricao"];
            
                //insere com os valores atualizados
                $query="UPDATE documento SET tipo_de_documento ='".$new_tipo_documento."' , descricao ='".$new_descricao."' , id_zona ='".$new_zona."'  WHERE id_documento =".$id;
                
                if(mysqli_query($conn,$query)){
                    echo "Registo editado com sucesso!";
                    header('Location: admin_documentos.php');
                }else{
                    echo "Nao editou o registo!";
                }
  
            
            }
?>