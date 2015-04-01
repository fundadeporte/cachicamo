<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/tcpdf/tcpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends TCPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){

       }
       // El pie del pdf
       public function Footer(){
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
		$html = "<table>";
		$html .= "<tr><td>unidad de adm y serv</td><td>responsable del proyecto o accion centralizada</td><td>unidad de finanzas</td><td>unidad de planificacion ppto</td><td>presidente</td><td>secreatria de adcripcion</td><td>Secretaria de Planificacion presupuesto y control de gestion</td><td>Gobernador del estado</td></tr>";
		$html .= "<tr><td>.</td><td>.</td><td>.</td><td>.</td><td>.</td><td>.</td><td>.</td><td>.</td></tr>";
		$html .= "</table>";
		$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
      }
    }
?>