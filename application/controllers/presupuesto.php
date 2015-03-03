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

        $data['query'] = $this->presupuesto_model->todas_las_modificaciones(2014);
        $this->load->view('header');
        $this->load->view('presupuesto/modificaciones/index',$data);
        $this->load->view('footer');
    }
    
    function ver($codigo_departamento,$sede)
    {
        $data = $this->departamento_model->ver($codigo_departamento,$sede);
        //print_r($data);
        $this->load->view('header');
        $this->load->view('departamentos/ver',$data);
        $this->load->view('footer');
    }
    
   
}
 
/* End of file departamento.php */
/* Location: ./application/controllers/departamento.php */