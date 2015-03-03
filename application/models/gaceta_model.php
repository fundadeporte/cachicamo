<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gaceta_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function todas_las_gacetas()
    {
        //get all entry
        $query = $this->db->get('ano');
        return $query->result();
    }
 
}
 
/* End of file gaceta_model.php */
/* Location: ./application/models/gaceta_model.php */