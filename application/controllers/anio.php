<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anio extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->model('anio_model');
        $this->load->helper('url');
    }
 
    function index()
    {
        //this function will retrive all entry in the database
        $data['query'] = $this->anio_model->todas_los_anios();
        $this->load->view('header');
        $this->load->view('anios/index',$data);
        $this->load->view('footer');
    }
 
   
}
 
/* End of file Anio.php */
/* Location: ./application/controllers/anio.php */