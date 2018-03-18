<?php
    require_once 'libs/fpdf/fpdf.php';

    class PDF extends FPDF{

        function __construct(){
            parent::__construct();
            $this->AddPage();
        }

        public function generarPublicacionEnPDF($publicacion,$fotosPublicacion){     
            $this->titulo(utf8_decode($publicacion->titulo),$publicacion->tipo);
            $this->especieRaza(utf8_decode($publicacion->especie),utf8_decode($publicacion->raza));
            $this->imprimirImagenes($fotosPublicacion);
            $this->imprimirDescripcionContacto(utf8_decode($publicacion->descripcion),utf8_decode($publicacion->usr_nom),$publicacion->usr_email);
            $this->Output();
        }

        // Page header
        private function titulo($titulo,$tipo)
        {
            $this->SetTitle($titulo);
            $this->SetFont('Arial','B',15);
            $this->Cell(80);   

            if($tipo == 'E'){
                $this->setearColor(21, 87, 36);
                $this->Cell(35,10,'Encontrado',1,1,'C');
            }else{
                $this->setearColor(114, 28, 36);
                $this->Cell(35,10,'Perdido',1,1,'C');
            }
            
            $this->Ln(5);

            $this->setearColor(0, 0, 0);

            $this->SetTitle($titulo);

            // Move to the right
            $this->Cell(80);
            // Title
            $this->Cell(30,10,$titulo,0,0,'C');
            // Line break
            $this->Ln(10);
        }

        private function setearColor($r,$g,$b){
            $this->SetTextColor($r, $g, $b);
            $this->SetDrawColor($r, $g, $b);
        }

        private function especieRaza($especie,$raza){
            $this->SetFont('Arial','',12);
            $this->Cell(0,10,$especie.' > '.$raza,0,1);
        }

        function Footer()
        {
            // Page footer
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->SetTextColor(128);
            $this->Cell(180,10,'PhpPerros&Cia.',0,0,'C');
        }


        private function imprimirImagenes($imagenes){
            $this->SetY(50);
            foreach ($imagenes as $foto) {
                $this->Image($foto,NULL,NULL,70);
                $this->Ln(1);
            }
        }

        private function imprimirDescripcionContacto($descripcion,$nombre,$email){
            $this->SetLeftMargin(90);
            $this->SetX(10);
            $this->SetY(50);
            $this->SetFont('Times','',12);
            // Output text in a 6 cm width column
            $this->MultiCell(100,5,$descripcion);
            $this->Ln(10);
            $this->SetFont('Arial','B',15);
            $this->MultiCell(100,5,'Contacto');
            $this->Ln(1);
            $this->SetFont('Times','',12);
            $this->MultiCell(100,5,$nombre);
            $this->MultiCell(100,5,$email);
        }

    }