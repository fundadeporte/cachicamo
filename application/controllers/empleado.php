<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empleado extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->model('empleado_model');
        $this->load->helper('url','html');
        $this->load->library('letras');
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

   function caja_ahorro()
   {
        $data['empleados'] = $this->empleado_model->listado_cajaahorro();
         $this->load->view('empleados/caja_ahorro',$data);
   }

   function constacia($cedula)
   {
        $cabecera = $this->empleado_model->cabecera_constacia($cedula);
        $this->load->view('empleados/constancia/cabecera',$cabecera);

   }

   function egresados()
   {
        $data['anios'] = $this->empleado_model->lista_egreados_anio();
        $this->load->view('empleados/egresados/index',$data);

   }

   function lista_egrasados($anio)
   {
        $data['empleados'] = $this->empleado_model->egresados_por_anio($anio);
        $this->load->view('empleados/egresados/lista',$data);
   }

   function constancia_egresado($cedula)
   {
        //
    function convert_number_to_words($number) {
       
        $hyphen      = ' ';
        $conjunction = ' ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'cero',
            1                   => 'uno',
            2                   => 'dos',
            3                   => 'tres',
            4                   => 'cuatro',
            5                   => 'cinco',
            6                   => 'seis',
            7                   => 'siete',
            8                   => 'ocho',
            9                   => 'nueve',
            10                  => 'diez',
            11                  => 'once',
            12                  => 'doce',
            13                  => 'trece',
            14                  => 'catorce',
            15                  => 'quince',
            16                  => 'diecisies',
            17                  => 'dicisiete',
            18                  => 'diesiocho',
            19                  => 'diecinueve',
            20                  => 'veinte',
            30                  => 'treinta',
            40                  => 'cuarenta',
            50                  => 'cincuenta',
            60                  => 'sesenta',
            70                  => 'setenta',
            80                  => 'ochenta',
            90                  => 'noventa',
            100                 => 'cien',
            500                 => 'quinientos',
            1000                => 'mil',
            1000000             => 'millon',
            1000000000          => 'billon',
            1000000000000       => 'trillon',
            1000000000000000    => 'cuadrillon',
            1000000000000000000 => 'quintillon'
        );
       
        if (!is_numeric($number)) {
            return false;
        }
       
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
       
        $string = $fraction = null;
       
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
       
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }
       
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        $string = str_replace("uno cien","ciento ", $string);
        $string = str_replace("dos cien","docientos ", $string);
        $string = str_replace("tres cien","trecientos ", $string);
        $string = str_replace("cuatro cien","cuantrocientos ", $string);
        $string = str_replace("cinco cien","quinientos ", $string);
        $string = str_replace("seis cien","seiscientos ", $string);
        $string = str_replace("siete cien","setecientos ", $string);
        $string = str_replace("ocho cien","ochocientos ", $string);
        $string = str_replace("nueve cien","novecientos ", $string);
        $string = str_replace("cinco cien","quinientos ", $string);
        
        return $string;
    }

    //
        $data['empleado'] = $this->empleado_model->constacia_egresado($cedula);
        $data['empleado'][0]['sueldo_en_letras'] = convert_number_to_words(substr($data['empleado'][0]['ultimo_sueldo'],0,-3));
        $cent = substr($data['empleado'][0]['ultimo_sueldo'],-2);
        if ($cent == '00'):
            $cent = "exactos. ";
        else:
            
            $cent = "con $cent/100 centimos";
        endif;
        $data['empleado'][0]['centimos'] = $cent;
        //print_r($empleado);
        $this->load->view('empleados/egresados/constancia',$data);
   }


}
 
/* End of file Anio.php */
/* Location: ./application/controllers/anio.php */