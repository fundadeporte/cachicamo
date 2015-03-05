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
 function reporte_modificacion($anio)
    {
      //Consulta de reporte de modificacion presupuestaria Cabecera
      /*  
      SELECT modificacion . nro_modificacion,   
        modificacion . cod_ano,   
        modificacion . fecha_documento,   
        modificacion . flag_interna_externa,
        modificacion . flag_reserva, 
        modificacion . fecha_aprobacion,   
        modificacion . fecha_anulacion, modificacion . monto, 
        tipo_de_documento . descripcion_documento,
        modificacion . status_m 
     FROM modificacion,   
           tipo_de_documento, 
           modifica_modifica 
      WHERE modificacion . tipo_documento = tipo_de_documento . tipo_documento and
          modificacion . tipo_documento = modifica_modifica . mod_tipo_documento and
          modificacion . nro_modificacion = modifica_modifica . nro_modificacion and
          modificacion . cod_ano = modifica_modifica . mod_cod_ano and
          modificacion . cod_organismo = modifica_modifica . cod_organismo
      order by tipo_de_documento . descripcion_documento,
          modificacion . nro_modificacion
      Fin de la consulta
      */
      //Convertir la consulta al formato codeigniter
      $saacp = $this->load->database('saacp', TRUE);

      $datos = array(
          'modificacion.nro_modificacion as nro_modificacion',   
          'modificacion.cod_ano as cod_ano',   
          'modificacion.fecha_documento',   
          'modificacion.flag_interna_externa',
          'modificacion.flag_reserva', 
          'modificacion.fecha_aprobacion',
          'modificacion.fecha_anulacion',
          'modificacion.monto',
          'tipo_de_documento.descripcion_documento as descripcion',
          'modificacion . status_m' 
        );
      $saacp->select($datos);
      $saacp->from('modificacion, tipo_de_documento, modifica_modifica');
      $saacp->where('modificacion.tipo_documento = tipo_de_documento.tipo_documento');
      $saacp->where('modificacion.tipo_documento = modifica_modifica.mod_tipo_documento');
      $saacp->where('modificacion.nro_modificacion = modifica_modifica.nro_modificacion');
      $saacp->where('modificacion.cod_ano = modifica_modifica.mod_cod_ano');
      $saacp->where('modificacion.cod_organismo = modifica_modifica.cod_organismo');
      $saacp->where('modificacion.cod_ano', $anio);
      $saacp->order_by('tipo_de_documento . descripcion_documento, modificacion . nro_modificacion');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }
 function modificacion_detallada($anio, $nro_modificacion)
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
        $saacp = $this->load->database('saacp', TRUE);

        $datos = array(
            'modificacion.cod_organismo',   
            'modificacion.cod_ano',   
            'modificacion.tipo_documento',   
            'modificacion.nro_modificacion',   
            'modificacion.flag_reserva',   
            'modificacion.concepto as concepto',   
            'modificacion.monto as monto',   
            'modificacion.fecha_documento',   
            'modificacion.fecha_proceso',   
            'modificacion.fecha_aprobacion',   
            'modificacion.fecha_afectacion',   
            'modificacion.status_m',   
            'modificacion.fecha_anulacion',   
            'modificacion.flag_interna_externa',   
            'modificacion.hora_proceso',   
            'tipo_de_documento.tipo_documento',   
            'tipo_de_documento.descripcion_documento',   
            'modificacion_partida.cod_programa as programa',   
            'modificacion_partida.cod_subprograma as sub_programa',   
            'modificacion_partida.cod_proyecto as proyecto',   
            'modificacion_partida.cod_act_obra as obra',   
            'modificacion_partida.cod_cuenta',   
            'modificacion_partida.ordinal_presupuesto',   
            'modificacion_partida.monto',   
            'modificacion_partida.signo',   
            'presupuesto.descripcion'  
          );
          
          $saacp->select($datos);
          $saacp->from('modificacion, tipo_de_documento, modificacion_partida, presupuesto');
          $saacp->where('modificacion . tipo_documento = tipo_de_documento . tipo_documento');
          $saacp->where('modificacion_partida.cod_organismo = modificacion.cod_organismo ');
          $saacp->where('modificacion_partida.cod_ano = modificacion.cod_ano  ');
          $saacp->where('modificacion_partida.tipo_documento = modificacion.tipo_documento');
          $saacp->where('modificacion_partida.nro_modificacion = modificacion.nro_modificacion');
          $saacp->where('presupuesto.cod_sector = modificacion_partida.cod_sector ');
          $saacp->where('presupuesto.cod_organismo = modificacion_partida.cod_organismo ');
          $saacp->where('presupuesto.cod_ano = modificacion_partida.cod_ano  ');
          $saacp->where('presupuesto.cod_programa = modificacion_partida.cod_programa ');
          $saacp->where('presupuesto.cod_subprograma = modificacion_partida.cod_subprograma');
          $saacp->where('presupuesto.cod_proyecto = modificacion_partida.cod_proyecto ');
          $saacp->where('presupuesto.cod_act_obra = modificacion_partida.cod_act_obra  ');
          $saacp->where('presupuesto.cod_cuenta = modificacion_partida.cod_cuenta ');
          $saacp->where('presupuesto.ordinal_presupuesto = modificacion_partida.ordinal_presupuesto');
          $saacp->where('modificacion.nro_modificacion',$nro_modificacion);
          $saacp->where('presupuesto.cod_ano', $anio);
          //$saccp->order_by('tipo_de_documento.descripcion_documento, modificacion.nro_modificacion, modificacion.cod_organismo, modificacion.cod_ano');
          $saacp->order_by('tipo_de_documento.descripcion_documento, modificacion.nro_modificacion');
          //Aquí se ejecuta la consulta
            $query = $saacp->get()->result_array();
          //Aquí retornan los datos al controlador
            return $query;
    }
/* End of file presupuesto_model.php */
/* Location: ./application/models/presupuesto_model.php */

 }
 
 