<?php

use Dompdf\Dompdf;

class dPdf extends Dompdf
{
	public function getHtmlWrapper($content){
		$content = '
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<title>Reporte</title>
				<link rel="stylesheet" type="text/css" media="screen" href="resources/css/custom-bootstrap-for-reports.css">
			</head>
			<body style="font-size: 70%">
			<div id="header">
				<table> 
					<tr>
						<td rowspan="3" style="width:60px;"> <img src="resources/img/logoCSASin.png" width="70" /> </td>
						<td>Clinica Santa Ana</td>
					</tr>
					<tr><td>10 de noviembre. zona San roque.</td></tr>
					<tr><td>Tel(2-62-645789)</td></tr>
				</table>
			</div>

			<div id="footer">
				<table>
					<tr>
						<td>Usuario: '.Yii::app()->user->name.'</td>
						<td>
							<div class="page-number">
							
							</div>
						</td>
					</tr>
				</table>
			</div>
			'.$content.'
			</body>
		</html>';
			
		return $content;
	}

	public function getComprobanteWrapper($content)
	{
		$footer2 ='
			<div id="footer2">
				<table table>
					<tr>
						<td>___________________________</td>
						<td>___________________________</td>
					</tr>
					<tr>
						<td>PREPARADO POR</td>
						<td>AUTORIZADO POR</td>
					</tr>
				</table>
			</div>
		';
		$content = $content.$footer2;
		$content = $this->getHtmlWrapper($content);
		return $content;
	}
	public function report()
	{
		// (Optional) Setup the paper size and orientation
		$this->setPaper('LETTER', 'portrait');

		
		// Render the HTML as PDF
		$this->render();

		// Output the generated PDF to Browser
		$this->stream("Reporte.pdf", array("Attachment" => false));
		exit(0);
	}
}