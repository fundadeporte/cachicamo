<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empleado extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->model('empleado_model');
        $this->load->helper('url');
    }
 
    function index()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        $data['query'] = $this->empleado_model->todos(1);
        $this->load->view('header');
        $this->load->view('empleados/index',$data);
        $this->load->view('footer');
    }
    
    function alto_nivel()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        $data['query'] = $this->empleado_model->todos(5);
        $this->load->view('header');
        $this->load->view('empleados/index',$data);
        $this->load->view('footer');
    }

    function obrero()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        $data['query'] = $this->empleado_model->todos(2);
        $this->load->view('header');
        $this->load->view('empleados/index',$data);
        $this->load->view('footer');
    }

    function agente()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        $data['query'] = $this->empleado_model->todos(4);
        $this->load->view('header');
        $this->load->view('empleados/index',$data);
        $this->load->view('footer');
    }

    function contratado()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        $data['query'] = $this->empleado_model->todos(3);
        $this->load->view('header');
        $this->load->view('empleados/index',$data);
        $this->load->view('footer');
    }
   function ver($id)
   {
        $lugar = $this->uri->segment(1, 0) . "/" . $this->uri->segment(2, 0) . "/" . $this->uri->segment(3, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);

        $data['empleado'] = $this->empleado_model->ver($id);
        $this->load->view('header');
        $this->load->view('empleados/ver',$data);
        $this->load->view('footer');   
   }
   function lista()
   {
        $lugar = $this->uri->segment(1, 0) . "/" . $this->uri->segment(2, 0) . "/" . $this->uri->segment(3, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        $data['empleados'] = $this->empleado_model->lista();
        $data['empleados_sin'] = $this->empleado_model->lista_sin();
        $this->load->view('header');
        $this->load->view('empleados/lista',$data);
        $this->load->view('footer');   
   }
}
 
/* End of file Anio.php */
/* Location: ./application/controllers/anio.php */