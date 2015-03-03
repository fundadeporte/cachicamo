<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nominas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->model('nomina_model');
        $this->load->helper('url');
    }
 
    function index()
    {
        //this function will retrive all entry in the database
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);

        $data['datos'] = $this->nomina_model->agrupar_nominas();
        $this->load->view('header');
        $this->load->view('nominas/index',$data);
        $this->load->view('footer');
    }

    function ver($anio,$mes)
    {

        $data['query'] = $this->nomina_model->ver($anio, $mes);
        $this->load->view('header');
        $this->load->view('nominas/ver',$data);
        $this->load->view('footer');
    }

    function caja_ahorro($anio, $mes)
    {
        $lugar = $this->uri->segment(1, 0) . "/";
        $data = array('ip' => $this->input->ip_address(), 'lugar' =>$lugar );
        $integra = $this->load->database('integra', TRUE);
        $integra->insert('visitas',$data);
        //Cargamos los conceptos de caja ahorro tanto pagos como abonos
        $data['empleados'] =  array_merge(
        $this->nomina_model->caja_ahorro($anio,$mes,1,array(233,101,47,48,168,54,79,93,96,144,139,134,140,232,80,38,92,31,39,146,150,229)),
        $this->nomina_model->caja_ahorro($anio,$mes,2,array(87,43,70,80,76,77,82,101,151,100,38,78,164,165,31,39,146,150,217)),
        $this->nomina_model->caja_ahorro($anio,$mes,3,array(89,98,103,97,100,104,99,167,85,101,102,31,39,146,150,191,199)),
        $this->nomina_model->caja_ahorro($anio,$mes,4,array(254,82,50,91,49,51,164,76,169,170,102,103,255,38,77,90,31,39,146,150,238,252)),
        $this->nomina_model->caja_ahorro($anio,$mes,5,array(101,47,48,49,54,79,84,93,96,144,139,134,140,80,38,92,31,39,146,150,185,2027)));
        //Cargamos los aportes patronales
        $data['patronales'] =  array_merge(
        $this->nomina_model->caja_ahorro($anio,$mes,1,array(31,39,146,150,229)),
        $this->nomina_model->caja_ahorro($anio,$mes,2,array(31,39,146,150,217)),
        $this->nomina_model->caja_ahorro($anio,$mes,3,array(31,39,146,150,191,199)),
        $this->nomina_model->caja_ahorro($anio,$mes,4,array(39,146,150,238,252)),
        $this->nomina_model->caja_ahorro($anio,$mes,5,array(39,146,150,185,2027)));
        //$this->load->view('header');
        //$this->load->view('nominas/caja_ahorro',$data);
        //$this->load->view('footer');
        $data['aniomes'] = "$anio-$mes";
        $this->load->view('nominas/archivo_csv',$data);
    }

    function formato_ocp($anio, $mes)
    {
        $data['tipo'] = array("01 =  EMPLEADOS","07 =  OBREROS", "02 =  CONTRATADOS", "01 =  EMPLEADOS","07 = ALTO NIVEL");
        $data['datos'] = array_merge(
            $this->nomina_model->formato_ocp($anio,$mes,1),
            $this->nomina_model->formato_ocp($anio,$mes,4),
            $this->nomina_model->formato_ocp($anio,$mes,3),
            $this->nomina_model->formato_ocpo($anio,$mes),
            $this->nomina_model->formato_ocpa($anio,$mes)
            );
        $this->load->view('header');
        $this->load->view('nominas/formato_ocp',$data);
        $this->load->view('footer');
    }
    
    function detalle_nomina($nro_control, $sede){
        $data['datos'] = $this->nomina_model->cabecera_nomina($nro_control,$sede);
        $data['nro_control'] = $nro_control;

        $this->load->view('header');
        $this->load->view('nominas/detalle_nomina',$data);
        $this->load->view('footer');
    }

    function recibo($nro_control,$cedula){
        $data['datos'] = $this->nomina_model->detalle_nomina($nro_control, $cedula);

        $this->load->view('header');
        $this->load->view('nominas/recibo',$data);
        $this->load->view('footer');
    }
}
 
/* End of file nominas.php */
/* Location: ./application/controllers/nominas.php */