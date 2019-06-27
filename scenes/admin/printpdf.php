<?php
	$html = file_get_contents("relatorios.php");

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega HTML
	$dompdf->load_html('
			<h1 style="text-align: center;">Relatório</h1>
            '. $html .'
         
		');

	//Renderizar o html
	$dompdf->render();

	//Exibir a página
	$dompdf->stream(
		"relatorio.pdf", 
		array(
			"Attachment" => false //Para realizar o download automatico alterar para true
		)
	);

	exit();	
?>

