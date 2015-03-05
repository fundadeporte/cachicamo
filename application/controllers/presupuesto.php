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
        //this function will retrive all entry in the database
        //$lugar = $this->uri->segment(1, 0) . "/";
        //$data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        //$this->db->insert('visitas',$data);
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        
        $anios = array(2013,2014 );
        $data['datos'] = $this->presupuesto_model->reporte_modificacion($anios);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/index',$data);
        $this->load->view('footer');
    }
    
    function ver($anio,$nro_modificacion)
    {
        $data['datos'] = $this->presupuesto_model->modificacion_detallada($anio,$nro_modificacion);
        //print_r($data);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/ver',$data);
        $this->load->view('footer');
    }
    
   
}
 
/* End of file departamento.php */
/* Location: ./application/controllers/departamento.php */