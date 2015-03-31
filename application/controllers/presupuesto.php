<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Presupuesto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        
        $this->load->model('presupuesto_model');
        $this->load->helper('url');
    }
 
    function index()
    {

        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        
        $an = array(2013,2014,2015 );
        $data['datos'] = $this->presupuesto_model->reporte_modificacion($an);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/index',$data);
        $this->load->view('footer');
    }
    
    function ver($anio,$nro_modificacion,$tipo)
    {
        $data['cabecera'] = $this->presupuesto_model->cabecera_modificacion($anio,$nro_modificacion,$tipo);
        $data['detalles'] = $this->presupuesto_model->modificacion_detalles($anio,$nro_modificacion,$tipo);
        $data['padres'] = $this->presupuesto_model->modificacion_padres($anio,$nro_modificacion,$tipo);
        $data['hijos'] = $this->presupuesto_model->modificacion_hijos($anio,$nro_modificacion,$tipo);
        //print_r($data);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/cabecera',$data);
        $this->load->view('presupuesto/modificaciones/detalle',$data);
        //$this->load->view('presupuesto/modificaciones/ver',$data);
        $this->load->view('footer');
    }

    function ver_modificacion($anio, $nro_modificacion,$tipo)
     {
        
        // Se carga la libreria fpdf
		$this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Israel Parra');
        $pdf->SetTitle('Ejemplo de provincías con TCPDF');
        $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('Helvetica', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $provincia = $this->input->post('provincia');
        $provincias = $this->presupuesto_model->modificacion_detalles($anio, $nro_modificacion,$tipo);
        foreach($provincias as $fila)
        {
            $prov = $fila['tipo_documento'];
        }
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h2>Localidades de ".$prov."</h2><h4>Actualmente: ".count($provincias)." localidades</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Id localidad</th><th>Localidades</th></tr>";
        
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
        foreach ($provincias as $fila)
        {
            $id = $fila['nro_modificacion'];
            $localidad = $fila['nro_modificacion'];
			$pdf->AddPage();
            $html .= "<tr><td class='id'>ó" . $id . "</td><td class='localidad'>" . $localidad . "</td></tr>";
        }
        $html .= "</table>";
 
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
        $pdf->Output($nombre_archivo, 'I');
    
    }
	
	
    
   
}
 
/* End of file departamento.php */
/* Location: ./application/controllers/departamento.php */