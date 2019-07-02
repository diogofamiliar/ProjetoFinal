<?php
include __DIR__.'/../../core/connect.php';
include('pdf.php');

if(isset($_POST["hidden_html"]) && $_POST["hidden_html"] != '')
{
 $file_name = 'google_chart.pdf';
 $html = '<link rel="stylesheet" href="bootstrap.min.css">';
 $html .= $_POST["hidden_html"];

 $html1 = '<table border=1';	
 $html1 .= '<thead>';
 $html1 .= '<tr>';
 $html1 .= '<th>Condomínio</th>';
 $html1 .= '<th>Zona</th>';
 $html1 .= '<th>Número de Incidentes</th>';
 $html1 .= '</tr>';
 $html1 .= '</thead>';
 $html1 .= '<tbody>';
 
 $result_transacoes = "SELECT condominio.nome as nome_condominio, zona.nome as nome_zona, incidente.id_zona, COUNT(id_incidente) as incidentes FROM incidente INNER JOIN zona ON incidente.id_zona=zona.id_zona INNER JOIN condominio ON condominio.id_condominio=zona.id_condominio GROUP BY id_zona ORDER BY incidentes DESC";
 $resultado_trasacoes = mysqli_query($conn, $result_transacoes);

 while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
     $html1 .= '<tr><td>'.utf8_encode($row_transacoes['nome_condominio']) . "</td>";
     $html1 .= '<td>'.utf8_encode($row_transacoes['nome_zona']) . "</td>";
     $html1 .= '<td>'.utf8_encode($row_transacoes['incidentes']) . "</td></tr>";
 }
 
 $html1 .= '</tbody>';
 $html1 .= '</table';

 $pdf = new Pdf();
 $pdf->load_html($html . $html1);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}

?>
