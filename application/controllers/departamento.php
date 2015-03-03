<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Departamento extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        
        $this->load->model('departamento_model');
        $this->load->helper('url');
    }
 
    function index()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);

        $sedes = array(1);
        $data['query'] = $this->departamento_model->todos($sedes);
        $this->load->view('header');
        $this->load->view('departamentos/index',$data);
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