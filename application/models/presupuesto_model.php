<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Presupuesto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        $this->load->database('saacp', TRUE);
    }
 
    function todas_las_modificaciones($anio)
    {
        //get all entry
        if (!$anio):
            $anio = date('Y');
        endif;
        $saacp = $this->load->database('saacp', TRUE);
        $saacp->where('cod_ano',$anio);
        $saacp->order_by('nro_modificacion');
        $query = $saacp->select('nro_modificacion, concepto, monto, fecha_documento, fecha_proceso, status_m, hora_proceso')->get('modificacion');
        return $query->result();
    }
 //function reporte_modificacion($anio)
    {

    //SELECT modificacion . nro_modificacion,   
      // modificacion . cod_ano,   
       //modificacion . fecha_documento,   
       //modificacion . flag_interna_externa,
       //modificacion . flag_reserva, 
       //modificacion . fecha_aprobacion,   
       //modificacion . fecha_anulacion, modificacion . monto, 
       //tipo_de_documento . descripcion_documento,
       //modificacion . status_m 
    //FROM modificacion,   
         //tipo_de_documento, 
         //modifica_modifica 
//WHERE modificacion . tipo_documento = tipo_de_documento . tipo_documento and
//modificacion . tipo_documento = modifica_modifica . mod_tipo_documento and
//modificacion . nro_modificacion = modifica_modifica . nro_modificacion and
//modificacion . cod_ano = modifica_modifica . mod_cod_ano and
//modificacion . cod_organismo = modifica_modifica . cod_organismo and

//order by tipo_de_documento . descripcion_documento,
  //       modificacion . nro_modificacion

// Consulta de reporte de modificacon presupuestaria
//      
}
 
/* End of file presupuesto_model.php */
/* Location: ./application/models/presupuesto_model.php */
