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
		$data['arbol'] = $this->presupuesto_model->arbol($anio,$nro_modificacion,$tipo);
		$data['enla'] = array('anio' => $anio, 'nro_modificacion' => $nro_modificacion, 'tipo' => $tipo);
        //print_r($data);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/cabecera',$data);
        $this->load->view('presupuesto/modificaciones/detalle',$data);
        //$this->load->view('presupuesto/modificaciones/ver',$data);
        $this->load->view('footer');
    }

    function formato_seplan($anio, $nro_modificacion,$tipo)
     {
        
        // Se carga la libreria fpdf
		$this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Legal', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cachicamo');
        $pdf->SetTitle('Modificacion presupuestaria');
        $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        //$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
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
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $arbol = $this->presupuesto_model->arbol($anio,$nro_modificacion,$tipo);
        
        //preparamos y maquetamos el contenido a crear
        $html = '';
        
		$html .= '<style>
		table { border-collapse; collapse;}
		td, th {
			
			padding: 0.5rem;
			display: inline;
		}
		.proyecto {
			font-size: 6px;
		}
		
		.denominacion {
			font-size: 10px;
			text-align: left;
			border-left-width: 1px;
			border-left: black;
		}
		
		.monto {
			font-size: 10px;
			text-align: right;
			width: 100px;
			border-left-width: 1px;
			border-left: black;
			border-right-width: 1px;
			border-right: black;
		}

		</style>';
		$html .= "<p>Solicitud de modificación presupuestaria consolidada</p>";
        $html .= '<table>
    <tr>
      <th width="30" class="proyecto">Proyecto o Accion Centraliza</th>
      <th width="30" class="proyecto">Accion Especifica</th>
      <th width="30" class="proyecto">Part</th>
      <th width="30" class="proyecto">Gen</th>
      <th width="30" class="proyecto">Esp</th>
      <th width="30" class="proyecto">sub-esp</th>
      <th width="25" class="proyecto">Ordinal</th>
      <th width="350" class="proyecto">DENOMINACION</th>
      <th class="monto">Bolivares</th>
    </tr>';
    if($arbol):foreach($arbol as $arbol):
	if ($arbol['signo'] == '-'):
		$monto = "(" . number_format($arbol['monto'],2,",",".") . ")";
	else:
		$monto = number_format($arbol['monto'],2,",",".") ;
	endif;
    $html .= '<tr>
      <td class="denominacion">' . $arbol['proyecto'] .'</td>
      <td class="denominacion"><b>'.  $arbol['accion_especifica'] .'</b></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion">'.utf8_decode($arbol['denominacion']) .'</td>
      <td class="monto">'. $monto .'</td>
    </tr>';
	$html .='	<tr>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion">'. $arbol['hijo']['part']. '</td>
      <td class="denominacion">'. $arbol['hijo']['gen']. '</td>
      <td class="denominacion">'. $arbol['hijo']['esp']. '</td>
      <td class="denominacion">'. $arbol['hijo']['sub_esp'] .'</td>
	  <td class="denominacion"></td>
	  <td class="denominacion">'. utf8_encode($arbol['hijo']['denominacion']) .'</td>
      <td class="monto">'. $monto.'</td>
    </tr>';
	if ($arbol['nieto']['signo'] == '-'):
		$monto = "(" . number_format($arbol['nieto']['monto'],2,",",".") . ")";
	else:
		$monto = number_format($arbol['nieto']['monto'],2,",",".") ;
	endif;
	$html .='	<tr>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion">'. $arbol['nieto']['part']. '</td>
      <td class="denominacion">'. $arbol['nieto']['gen']. '</td>
      <td class="denominacion">'. $arbol['nieto']['esp']. '</td>
      <td class="denominacion">'. $arbol['nieto']['sub_esp'] .'</td>
	  <td class="denominacion"></td>
	  <td class="denominacion">'. utf8_encode($arbol['nieto']['denominacion']) .'</td>
      <td class="monto">'. $monto.'</td>
    </tr>';
	foreach($arbol['bisnieto'] as $bisnieto): 
	if ($bisnieto['signo'] == '-'):
		$monto = "(" . number_format($bisnieto['monto'],2,",",".") . ")";
	else:
		$monto = number_format($bisnieto['monto'],2,",",".") ;
	endif;
	$html .= '<tr>
      <td class="denominacion"></td>
	  <td class="denominacion"></td>
      <td class="denominacion">'. $bisnieto['part'] .'</td>
      <td class="denominacion">'. $bisnieto['gen'] .'</td>
      <td class="denominacion">'. $bisnieto['esp'] .'</td>
      <td class="denominacion">'. $bisnieto['sub_esp'] .'</td>
	  <td class="denominacion">'. $bisnieto['ordinal'] .'</td>
	  <td class="denominacion">'. utf8_encode($bisnieto['denominacion']) .'</td>
      <td class="monto">'. $monto .'</td>
    </tr>';
	endforeach;

    endforeach; else:
	
    endif;
		$html .= "</table>";
		$pdf->Ln();
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

//
	$arbol = $this->presupuesto_model->arbol($anio,$nro_modificacion,$tipo);
    if($arbol):foreach($arbol as $arbol):
		$pdf->AddPage();
		$html = '';
		$html .= '<style>
		table { border-collapse; collapse;}
		td, th {
			
			padding: 0.5rem;
			display: inline;
		}
		.proyecto {
			font-size: 6px;
		}
		
		.denominacion {
			font-size: 10px;
			text-align: left;
			border-left-width: 1px;
			border-left: black;
		}
		
		.monto {
			font-size: 10px;
			text-align: right;
			width: 100px;
			border-left-width: 1px;
			border-left: black;
			border-right-width: 1px;
			border-right: black;
		}

		</style>';
		$html .= "<p>Solicitud de modificación presupuestaria por unidad ejecutora</p>";
        $html .= '<table>
    <tr>
      <th width="30" class="proyecto">Proyecto o Accion Centraliza</th>
      <th width="30" class="proyecto">Accion Especifica</th>
      <th width="30" class="proyecto">Part</th>
      <th width="30" class="proyecto">Gen</th>
      <th width="30" class="proyecto">Esp</th>
      <th width="30" class="proyecto">sub-esp</th>
      <th width="25" class="proyecto">Ordinal</th>
      <th width="350" class="proyecto">DENOMINACION</th>
      <th class="monto">Bolivares</th>
    </tr>';
	if ($arbol['signo'] == '-'):
		$monto = "(" . number_format($arbol['monto'],2,",",".") . ")";
	else:
		$monto = number_format($arbol['monto'],2,",",".") ;
	endif;
    $html .= '<tr>
      <td class="denominacion">' . $arbol['proyecto'] .'</td>
      <td class="denominacion"><b>'.  $arbol['accion_especifica'] .'</b></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion">'.utf8_decode($arbol['denominacion']) .'</td>
      <td class="monto">'. $monto .'</td>
    </tr>';
	$html .='	<tr>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion">'. $arbol['hijo']['part']. '</td>
      <td class="denominacion">'. $arbol['hijo']['gen']. '</td>
      <td class="denominacion">'. $arbol['hijo']['esp']. '</td>
      <td class="denominacion">'. $arbol['hijo']['sub_esp'] .'</td>
	  <td class="denominacion"></td>
	  <td class="denominacion">'. utf8_encode($arbol['hijo']['denominacion']) .'</td>
      <td class="monto">'. $monto.'</td>
    </tr>';
	if ($arbol['nieto']['signo'] == '-'):
		$monto = "(" . number_format($arbol['nieto']['monto'],2,",",".") . ")";
	else:
		$monto = number_format($arbol['nieto']['monto'],2,",",".") ;
	endif;
	$html .='	<tr>
      <td class="denominacion"></td>
      <td class="denominacion"></td>
      <td class="denominacion">'. $arbol['nieto']['part']. '</td>
      <td class="denominacion">'. $arbol['nieto']['gen']. '</td>
      <td class="denominacion">'. $arbol['nieto']['esp']. '</td>
      <td class="denominacion">'. $arbol['nieto']['sub_esp'] .'</td>
	  <td class="denominacion"></td>
	  <td class="denominacion">'. utf8_encode($arbol['nieto']['denominacion']) .'</td>
      <td class="monto">'. $monto.'</td>
    </tr>';
	foreach($arbol['bisnieto'] as $bisnieto): 
	if ($bisnieto['signo'] == '-'):
		$monto = "(" . number_format($bisnieto['monto'],2,",",".") . ")";
	else:
		$monto = number_format($bisnieto['monto'],2,",",".") ;
	endif;
	$html .= '<tr>
      <td class="denominacion"></td>
	  <td class="denominacion"></td>
      <td class="denominacion">'. $bisnieto['part'] .'</td>
      <td class="denominacion">'. $bisnieto['gen'] .'</td>
      <td class="denominacion">'. $bisnieto['esp'] .'</td>
      <td class="denominacion">'. $bisnieto['sub_esp'] .'</td>
	  <td class="denominacion">'. $bisnieto['ordinal'] .'</td>
	  <td class="denominacion">'. utf8_encode($bisnieto['denominacion']) .'</td>
      <td class="monto">'. $monto .'</td>
    </tr>';
	endforeach;
	$html .= "</table>";
	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
    endforeach; 
	
	else:
	
    endif;
		
//

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("modificacion_$anio$nro_modificacion$tipo.pdf");
        $pdf->Output($nombre_archivo, 'I');
    
    }
	
	
    
   
}
 
/* End of file departamento.php */
/* Location: ./application/controllers/departamento.php */