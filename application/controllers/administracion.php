<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administracion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        
        $this->load->model('administracion_model');
        $this->load->helper('url');
    }
 
    function index()
    {

        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        
        
        $this->load->view('header');
        $this->load->view('administracion/compras/index',$data);
        $this->load->view('footer');
    }
    
    function ver($anio,$nro_modificacion)
    {
        $data['cabecera'] = $this->presupuesto_model->cabecera_modificacion($anio,$nro_modificacion);
        $data['detalles'] = $this->presupuesto_model->modificacion_detalles($anio,$nro_modificacion);
        //print_r($data);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/cabecera',$data);
        $this->load->view('presupuesto/modificaciones/detalle',$data);
        //$this->load->view('presupuesto/modificaciones/ver',$data);
        $this->load->view('footer');
    }
//La parte de compras
    function ordenes_compra()
    {
        $data['datos'] = $this->administracion_model->ordenes_compra();

        $this->load->view('header');
        $this->load->view('administracion/compras/ordenes',$data);
        $this->load->view('footer');

    }
    
    function ver_ordenes_compra_anio($anio)
    {
        $data['datos'] = $this->administracion_model->ver_ordenes_compra_anio($anio);

        $this->load->view('header');
        $this->load->view('administracion/compras/detalle_ordenes',$data);
        $this->load->view('footer');
    }

    function ordenes_servicio()
    {
        $data['datos'] = $this->administracion_model->ordenes_servicio();

        $this->load->view('header');
        $this->load->view('administracion/compras/ordenes',$data);
        $this->load->view('footer');

    }
   
    function ver_ordenes_servicio_anio($anio)
    {
        $data['datos'] = $this->administracion_model->ver_orden_servicio_anio($anio);

        $this->load->view('header');
        $this->load->view('administracion/compras/detalle_ordenes',$data);
        $this->load->view('footer');
    }
    function contratos()
    {
        $data['datos'] = $this->administracion_model->contratos();

        $this->load->view('header');
        $this->load->view('administracion/compras/ordenes',$data);
        $this->load->view('footer');

    }
   
    function ver_contratos_anio($anio)
    {
        $data['datos'] = $this->administracion_model->ver_contratos_anio($anio);

        $this->load->view('header');
        $this->load->view('administracion/compras/detalle_ordenes',$data);
        $this->load->view('footer');
    }
}
 
/* End of file administracion.php */
/* Location: ./application/controllers/administracion.php */