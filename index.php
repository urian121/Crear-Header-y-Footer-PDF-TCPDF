<?php
require_once('tcpdf/tcpdf.php');
date_default_timezone_set('America/Bogota');


class MYPDF extends TCPDF {

	
	public function Header() {
		$path = dirname( __FILE__ );
		$logo = $path.'/img/logo2.png';

		/**Logo Derecha */
		$bMargin = $this->getBreakMargin();
		$auto_page_break = $this->AutoPageBreak;
		$this->SetAutoPageBreak(false, 0);
		//$img_file = '/img/logo.png';
		$img_file = dirname( __FILE__ ) .'/img/logo.png';
		$this->Image($img_file, 10, 8, 20, 20, '', '', '', false, 30, '', false, false, 0);
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		$this->setPageMark();

		$this->Ln(20);
		/**Logo Izquierdo  $this->Image('src imagen', Eje X, Eje Y, Tamaño de la Imagen );*/ 
		$this->Image($logo, 180, 12, 15 );
		$this->SetFont('helvetica','B',18); //('helvetica','B',8)
		$this->Cell(30);
		$this->Cell(105,30, 'Comunidad WebDeveloper',0,0,'C');

		$this->SetFont('helvetica','B',8); //Tipo de fuente y tamaño de letra
		$this->SetXY(130, 29);
		$this->SetTextColor(34,68,136);
		$this->Write(0, 'Bogotá - Colombia '. date('d-m-Y h:i A'));
	}



		public function Footer() {
			$this->SetY(-15);
			$this->SetFont('helvetica', '', 8);
			//Mostrar cantidad de paginas
			//$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->html = '<p style="border-top:1px solid #999; text-align:center;">
							Footer desarrollado por: <strong> WebDeveloper </strong> 
							</p>';
			$this->writeHTML($this->html, true, false, true, false, '');
		}
}



//CREANDO NUEVO DOCUMNETO PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//establecer margenes
$pdf->SetMargins(25, 35, 25);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(true); //Defino el estado del footer
$pdf->setPrintHeader(true); //Defino el estado del Header
$pdf->SetAutoPageBreak(false); 

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);


// add a page
$pdf->AddPage();


$pdf->Output('pdf'.date('Y-m-d').'.pdf', 'I');

