<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gaceta extends CI_Controller
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
        $this->load->view('anios/index',$data);
    }
 

}
 
/* End of file blog.php */
/* Location: ./application/controllers/blog.php */