<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anio_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function todas_los_anios()
    {
        //get all entry
        $query = $this->db->get('ano');
        return $query->result();
    }
 
}
 
/* End of file anio_model.php */
/* Location: ./application/models/anio_model.php */