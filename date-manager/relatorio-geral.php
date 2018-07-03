<?php
//version 1.81 fpdf
require_once "files/fpdf/fpdf.php";


//Inicia O documento PDF com orientação P - Retrato (Picture) OU L - Paisagem (Landscape)
$pdf = new FPDF("P");
$pdf->AddPage();
//NOME DO ARQUIVO AO SER GERADO ou GERA O NOME DO ARQUIVO COM O LOCAL A SER SALVO
$arquivo = "relatorio-geral.pdf";
//DEFININDO FORMATACOES DO PDF
$fonte = "Arial";
$estilo = "B";
$border = 1;
$alinhamentoL = "L";
$alinhamentoC = "C";
/*
GERAR COMO
I: Envia o arquivo para o navegador. O visualizador de PDF é usado se disponível.
D: Enviar para o navegador e forçar o arquivo um download com o nome especificado.
F: Salva o arquivo local com o nome dado por name(pode incluir um caminho).
S: Retorna o documento como uma string.
DEFAULT: O valor padrão é I.
*/

$tipo_pdf = "I";

$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

$pdf->SetFont('Helvetica', '', 14);
$pdf->Write(2, 'Relatorio Geral das Certidoes');
$pdf->Ln();

$pdf->SetFontSize(10);
$pdf->Ln();

$pdf->Ln(4);

$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(18 ,7, 'Empresa', 1);
$pdf->Cell(20 ,7, 'Receita', 1);
$pdf->Cell(20 ,7, 'Caixa', 1);
$pdf->Cell(20 ,7, 'Sefaz', 1);
$pdf->Cell(21 ,7, 'Concordata', 1);
$pdf->Cell(20 ,7, 'PMBV', 1);
$pdf->Cell(20 ,7, 'Alvara', 1);
$pdf->Cell(20 ,7, 'Suframa', 1);
$pdf->Cell(20 ,7, 'Digital', 1);
$pdf->Cell(20 ,7, 'Bombeiro', 1);
$pdf->Ln();

$pdf->SetFont('Helvetica', '', 10);

$sql = 'SELECT * FROM empresas ORDER BY razao_social';
 foreach($pdo->query($sql) as $row) {
 	 $pdf->Cell(18, 7, $row['razao_social'], 1);
     $pdf->Cell(20, 7, $row['receita_federal'], 1);
     $pdf->Cell(20, 7, $row['caixa_economica'], 1);
     $pdf->Cell(20, 7, $row['sefaz'], 1);
     $pdf->Cell(21, 7, $row['concordata'], 1);
     $pdf->Cell(20, 7, $row['pmbv'], 1);
     $pdf->Cell(20, 7, $row['alvara'], 1);
     $pdf->Cell(20, 7, $row['suframa'], 1);
     $pdf->Cell(20, 7, $row['digital'], 1);
     $pdf->Cell(20, 7, $row['bombeiro'], 1);
     $pdf->Ln();
 }


//FECHANDO O ARQUIVO
$pdf->Output($arquivo, $tipo_pdf);
?>
