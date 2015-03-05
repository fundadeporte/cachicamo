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

 }
 //function Modificacion_detallada($anio)
    {
//SELECT   modificacion . cod_organismo,   
  //       modificacion . cod_ano,   
    //     modificacion . tipo_documento,   
      //   modificacion . nro_modificacion,   
        // modificacion . flag_reserva,   
         //modificacion . concepto,   
         //modificacion . monto,   
         //modificacion . fecha_documento,   
         //modificacion . fecha_proceso,   
         //modificacion . fecha_aprobacion,   
         //modificacion . fecha_afectacion,   
         //modificacion . status_m,   
         //modificacion . fecha_anulacion,   
         //modificacion . flag_interna_externa,   
         //modificacion . hora_proceso,   
         //tipo_de_documento . tipo_documento,   
         //tipo_de_documento . descripcion_documento,   
         //modificacion_partida . cod_programa,   
         //modificacion_partida . cod_subprograma,   
         //modificacion_partida . cod_proyecto,   
         //modificacion_partida . cod_act_obra,   
         //modificacion_partida . cod_cuenta,   
         //modificacion_partida . ordinal_presupuesto,   
         //modificacion_partida . monto,   
         //modificacion_partida . signo,   
         //presupuesto . descripcion  
    //FROM modificacion,   
      //   tipo_de_documento,   
        // modificacion_partida,   
         //presupuesto  
   //WHERE modificacion . tipo_documento = tipo_de_documento . tipo_documento and  
   //      modificacion_partida . cod_organismo = modificacion . cod_organismo and  
   //      modificacion_partida . cod_ano = modificacion . cod_ano  and  
   //      modificacion_partida . tipo_documento = modificacion . tipo_documento  and  
   //      modificacion_partida . nro_modificacion = modificacion . nro_modificacion  and  
   //      presupuesto . cod_sector = modificacion_partida . cod_sector  and  
   //      presupuesto . cod_organismo = modificacion_partida . cod_organismo  and  
   //      presupuesto . cod_ano = modificacion_partida . cod_ano  and  
   //      presupuesto . cod_programa = modificacion_partida . cod_programa  and  
   //      presupuesto . cod_subprograma = modificacion_partida . cod_subprograma and  
   //      presupuesto . cod_proyecto = modificacion_partida . cod_proyecto and  
   //      presupuesto . cod_act_obra = modificacion_partida . cod_act_obra  and  
   //      presupuesto . cod_cuenta = modificacion_partida . cod_cuenta  and  
   //      presupuesto . ordinal_presupuesto = modificacion_partida . ordinal_presupuesto 
   
//ORDER BY  tipo_de_documento . descripcion_documento,   
  //       modificacion . nro_modificacion ,   
    //     modificacion . cod_organismo ,   
      //   modificacion . cod_ano   
        

        
}
 