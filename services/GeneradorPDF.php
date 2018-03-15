<?php

	require_once 'libs/fpdf/fpdf.php';

	class GeneradorPDF extends FPDF{

		protected $pub;
		protected $pdf;
		protected $fotos;

		public function generarPublicacionEnPDF($publicacion, $fotos){
			//var_dump($publicacion);die();
			$this->pub = $publicacion;
			$this->fotos = $fotos;
			$this->pdf = new FPDF();
			$this->pdf->AliasNbPages();
			$this->pdf->AddPage();

			$this->titulo();
			$this->especieRaza();
			$this->fotos();
			$this->descripcion();


			$this->pdf->Output();
		}

		// Page header
		public function titulo()
		{
		    $this->pdf->SetFont('Arial','B',15);
			$this->pdf->Cell(80);	

			if($this->pub->tipo == 'E'){
				$this->pdf->Cell(35,10,'Encontrado',1,1,'C');
			}else{
				$this->pdf->Cell(35,10,'Perdido',1,1,'C');
			}
			
			$this->pdf->Ln(5);

			$this->pdf->SetTitle($this->pub->titulo);

		    // Move to the right
		    $this->pdf->Cell(80);
		    // Title
		    $this->pdf->Cell(30,10,$this->pub->titulo,0,0,'C');
		    // Line break
		    $this->pdf->Ln(10);
		}


		public function especieRaza(){
			$this->pdf->SetFont('Arial','',12);
			$this->pdf->Cell(0,10,$this->pub->especie.' > '.$this->pub->raza,0,1);
		}

		public function fotos(){
			foreach ($this->fotos as $foto) {
				$this->pdf->Image($foto,NULL,NULL,70);
			}
		}

		public function descripcion(){
			$this->pdf->SetFont('Arial','',12);
			$this->pdf->Cell(0,60,$this->pub->descripcion,0,1);
		}

		// Page footer
		public function footer()
		{
		    // Position at 1.5 cm from bottom
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Page number
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}

	}