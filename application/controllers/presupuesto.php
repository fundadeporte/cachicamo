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

    function ver_modificacion($anio, $nro_modificacion)
    {

    }
    
   
}
 
/* End of file departamento.php */
/* Location: ./application/controllers/departamento.php */