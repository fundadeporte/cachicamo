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
          'modificacion.fecha_documento as fecha',   
          'modificacion.flag_interna_externa as clase',
          'modificacion.flag_reserva as aprobada', 
          'modificacion.fecha_aprobacion as fecha_aprobacion',
          'modificacion.fecha_anulacion as fecha_anulacion',
          'modificacion.monto',
          'tipo_de_documento.descripcion_documento as descripcion',
          'modificacion . status_m', 
          'modificacion.tipo_documento as tipo' 
        );
      $saacp->select($datos);
      $saacp->from('modificacion, tipo_de_documento, modifica_modifica');
      $saacp->where('modificacion.tipo_documento = tipo_de_documento.tipo_documento');
      $saacp->where('modificacion.tipo_documento = modifica_modifica.mod_tipo_documento');
      $saacp->where('modificacion.nro_modificacion = modifica_modifica.nro_modificacion');
      $saacp->where('modificacion.cod_ano = modifica_modifica.mod_cod_ano');
      $saacp->where('modificacion.cod_organismo = modifica_modifica.cod_organismo');
      $saacp->where_in('modificacion.cod_ano', $anio);
      $saacp->order_by('modificacion.cod_ano , clase ,tipo_de_documento . descripcion_documento, modificacion . nro_modificacion');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }

    function cabecera_modificacion($anio, $nro_modificacion, $tipo)
    {
      /*
      SELECT   modificacion . cod_organismo,   
               modificacion . cod_ano,   
               modificacion . tipo_documento,   
               modificacion . nro_modificacion,   
               modificacion . flag_reserva,   
               modificacion . concepto,   
               modificacion . monto,   
               modificacion . fecha_documento,   
               modificacion . fecha_proceso,   
               modificacion . fecha_aprobacion,   
               modificacion . fecha_afectacion,   
               modificacion . status_m,   
               modificacion . fecha_anulacion,   
               modificacion . flag_interna_externa,   
               modificacion . hora_proceso
          FROM modificacion
               
         WHERE 
              modificacion.cod_ano = 2015 and
              modificacion.nro_modificacion = 2

      */
      $saacp = $this->load->database('saacp', TRUE);

      $datos = array(
              'modificacion . cod_organismo',   
              'modificacion . cod_ano',   
              'modificacion . tipo_documento',   
              'modificacion . nro_modificacion',   
              'modificacion . flag_reserva as reserva',   
              'modificacion . concepto',   
              'modificacion . monto',   
              'modificacion . fecha_documento as fecha',   
              'modificacion . fecha_proceso',   
              'modificacion . fecha_aprobacion',   
              'modificacion . fecha_afectacion',   
              'modificacion . status_m',   
              'modificacion . fecha_anulacion',   
              'modificacion . flag_interna_externa as clase',   
              'modificacion . hora_proceso '
        );
      $saacp->select($datos);
      $saacp->from('modificacion');
      $saacp->where_in('modificacion.cod_ano', $anio);
      $saacp->where_in('modificacion.nro_modificacion', $nro_modificacion);
      $saacp->where('tipo_documento',$tipo); 
      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }
 
    function modificacion_detalles($anio, $nro_modificacion,$tipo)
    {
        /*
        SELECT   
                 modificacion . tipo_documento,   
                 modificacion . nro_modificacion,   
                 modificacion . flag_reserva,   
                 modificacion . monto,   
                 modificacion . fecha_documento,   
                 modificacion . fecha_proceso,   
                 modificacion . fecha_aprobacion,   
                 modificacion . fecha_afectacion,   
                 modificacion . status_m,   
                 modificacion . fecha_anulacion,   
                 modificacion . flag_interna_externa,   
                 modificacion . hora_proceso,   
                 tipo_de_documento . tipo_documento,   
                 tipo_de_documento . descripcion_documento,   
                 modificacion_partida . cod_programa,   
                 modificacion_partida . cod_subprograma,   
                 modificacion_partida . cod_proyecto,   
                 modificacion_partida . cod_act_obra,   
                 modificacion_partida . cod_cuenta,   
                 modificacion_partida . ordinal_presupuesto,   
                 modificacion_partida . monto,   
                 modificacion_partida . signo,   
                 presupuesto . descripcion  
            FROM modificacion,   
                 tipo_de_documento,   
                 modificacion_partida,   
                 presupuesto  
           WHERE modificacion . tipo_documento = tipo_de_documento . tipo_documento and  
                 modificacion_partida . cod_organismo = modificacion . cod_organismo and  
                 modificacion_partida . cod_ano = modificacion . cod_ano  and  
                 modificacion_partida . tipo_documento = modificacion . tipo_documento  and  
                 modificacion_partida . nro_modificacion = modificacion . nro_modificacion  and  
                 presupuesto . cod_sector = modificacion_partida . cod_sector  and  
                 presupuesto . cod_organismo = modificacion_partida . cod_organismo  and  
                 presupuesto . cod_ano = modificacion_partida . cod_ano  and  
                 presupuesto . cod_programa = modificacion_partida . cod_programa  and  
                 presupuesto . cod_subprograma = modificacion_partida . cod_subprograma and  
                 presupuesto . cod_proyecto = modificacion_partida . cod_proyecto and  
                 presupuesto . cod_act_obra = modificacion_partida . cod_act_obra  and  
                 presupuesto . cod_cuenta = modificacion_partida . cod_cuenta  and  
                 presupuesto . ordinal_presupuesto = modificacion_partida . ordinal_presupuesto and
                presupuesto.cod_ano = 2014 and
                modificacion.nro_modificacion = 1
           
        ORDER BY  tipo_de_documento . descripcion_documento,   
                 modificacion . nro_modificacion ,   
                 modificacion . cod_organismo ,   
                 modificacion . cod_ano

        */
        $saacp = $this->load->database('saacp', TRUE);

        $datos = array(
                 'modificacion . tipo_documento',   
                 'modificacion . nro_modificacion',   
                 'modificacion . flag_reserva',   
                 'modificacion . monto',   
                 'modificacion . fecha_documento',   
                 'modificacion . fecha_proceso',   
                 'modificacion . fecha_aprobacion',   
                 'modificacion . fecha_afectacion',   
                 'modificacion . status_m',   
                 'modificacion . fecha_anulacion',   
                 'modificacion . flag_interna_externa',   
                 'modificacion . hora_proceso',   
                 'tipo_de_documento . tipo_documento',   
                 'tipo_de_documento . descripcion_documento',   
                 'modificacion_partida . cod_programa as programa',   
                 'modificacion_partida . cod_subprograma',   
                 'modificacion_partida . cod_proyecto ',   
                 'modificacion_partida . cod_act_obra accion_especifica',   
                 'modificacion_partida . cod_cuenta as cuenta',   
                 'modificacion_partida . ordinal_presupuesto as ordinal',   
                 'modificacion_partida . monto',   
                 'modificacion_partida . signo',   
                 'presupuesto . descripcion as denominacion'  
          
                    );
          
          $saacp->select($datos);
          $saacp->from('modificacion, tipo_de_documento, modificacion_partida, presupuesto');    
          $saacp->where(' modificacion . tipo_documento = tipo_de_documento . tipo_documento');  
          $saacp->where('modificacion_partida . cod_organismo = modificacion . cod_organismo ');
          $saacp->where('modificacion_partida . cod_ano = modificacion . cod_ano ');
          $saacp->where('modificacion_partida . tipo_documento = modificacion . tipo_documento');
          $saacp->where('modificacion_partida . nro_modificacion = modificacion . nro_modificacion ');
          $saacp->where('presupuesto . cod_sector = modificacion_partida . cod_sector ');
          $saacp->where('presupuesto . cod_organismo = modificacion_partida . cod_organismo');
          $saacp->where('presupuesto . cod_ano = modificacion_partida . cod_ano ');
          $saacp->where('presupuesto . cod_programa = modificacion_partida . cod_programa ');
          $saacp->where('presupuesto . cod_subprograma = modificacion_partida . cod_subprograma ');
          $saacp->where('presupuesto . cod_proyecto = modificacion_partida . cod_proyecto');
          $saacp->where('presupuesto . cod_act_obra = modificacion_partida . cod_act_obra');
          $saacp->where('presupuesto . cod_cuenta = modificacion_partida . cod_cuenta ');
          $saacp->where('presupuesto . ordinal_presupuesto = modificacion_partida . ordinal_presupuesto');
          $saacp->where('presupuesto.cod_ano', $anio);
          $saacp->where('modificacion.nro_modificacion', $nro_modificacion);
          $saacp->where('modificacion_partida.tipo_documento',$tipo); 
          $saacp->order_by('programa, accion_especifica,signo, cuenta');
          //Aquí se ejecuta la consulta
            $query = $saacp->get()->result_array();
          //Aquí retornan los datos al controlador
            return $query;
    }

    function modificacion_padres($anio,$nro_modificacion,$tipo)
    {
      /*
        select 
          modificacion_partida.signo,
          modificacion_partida.cod_programa,
          modificacion_partida.cod_act_obra, 
          descripcion, 
          sum(monto) as monto 
        from 
          modificacion_partida, actividad_obra 
        where 
          modificacion_partida.cod_ano = 2013 and 
          modificacion_partida.nro_modificacion = 227 and 
          modificacion_partida.tipo_documento = 'MOTP' and
          modificacion_partida.cod_ano = actividad_obra.cod_ano and
          modificacion_partida.cod_programa = actividad_obra.cod_programa and
          modificacion_partida.cod_subprograma = actividad_obra.cod_subprograma and
          modificacion_partida.cod_act_obra = actividad_obra.cod_act_obra
        group by
          modificacion_partida.signo,modificacion_partida.cod_programa, modificacion_partida.cod_act_obra,descripcion
        order by
          modificacion_partida.signo,modificacion_partida.cod_programa,modificacion_partida.cod_act_obra,descripcion

      */
      $saacp = $this->load->database('saacp', TRUE);

      $datos = array(
          'modificacion_partida.signo',
          'modificacion_partida.cod_programa',
          'modificacion_partida.cod_act_obra', 
          'descripcion', 
          'sum(monto) as monto '
        );
      $saacp->select($datos);
      $saacp->from('modificacion_partida, actividad_obra');    
      $saacp->where('modificacion_partida.cod_ano',$anio);  
      $saacp->where('modificacion_partida.nro_modificacion',$nro_modificacion);  
      $saacp->where('tipo_documento',$tipo); 
      $saacp->where('modificacion_partida.cod_ano = actividad_obra.cod_ano ');
      $saacp->where('modificacion_partida.cod_programa = actividad_obra.cod_programa ');
      $saacp->where('modificacion_partida.cod_subprograma = actividad_obra.cod_subprograma ');
      $saacp->where('modificacion_partida.cod_act_obra = actividad_obra.cod_act_obra');
      //$saacp->where('substr(cod_cuenta,4,2) <> 18');
      $saacp->group_by(array('modificacion_partida.signo','modificacion_partida.cod_programa', 'modificacion_partida.cod_act_obra','descripcion'));
      $saacp->order_by('modificacion_partida.signo,modificacion_partida.cod_programa, modificacion_partida.cod_act_obra,descripcion');

      $query = $saacp->get()->result_array();
          //Aquí retornan los datos al controlador
      return $query;

    }

    function modificacion_hijos($anio, $nro_modificacion, $tipo)
    {
      /*
        select 
          signo,
          cod_programa,
          cod_act_obra, 
          substr(modificacion_partida.cod_cuenta,1,3) as cuenta,
          substr(modificacion_partida.cod_cuenta,4,2) as hija,
          descripcion_cuenta as descripcion,
          sum(monto) as monto 
        from 
          modificacion_partida, plan_cuentas 
        where 
          cod_ano = 2013 and 
          nro_modificacion = 227 
          and tipo_documento = 'MOTP' 
          and modificacion_partida.cod_cuenta = plan_cuentas.cod_cuenta
        group by
          signo,cod_programa, cod_act_obra,cuenta,hija, descripcion
        order by
          signo,cod_programa,cod_act_obra,cuenta,hija, descripcion
      */
      $saacp = $this->load->database('saacp', TRUE);

      $datos = array(
        'signo',
        'cod_programa',
        'cod_act_obra', 
        'substr(modificacion_partida.cod_cuenta,1,3) as cuenta',
        'substr(modificacion_partida.cod_cuenta,4,2) as hija',
        'descripcion_cuenta as descripcion',
        'sum(monto) as monto '
        );
      $saacp->select($datos);
      $saacp->from('modificacion_partida, plan_cuentas');    
      $saacp->where('cod_ano',$anio);  
      $saacp->where('nro_modificacion',$nro_modificacion);  
      $saacp->where('cod_ano',$anio);  
      $saacp->where('tipo_documento',$tipo); 
      $saacp->where('modificacion_partida.cod_cuenta = plan_cuentas.cod_cuenta');
      $saacp->group_by(array('signo','cod_programa','cod_act_obra', 'cuenta', 'hija', 'descripcion'));
      $saacp->order_by('signo, cod_programa, cod_act_obra, cuenta, hija, descripcion');

      $query = $saacp->get()->result_array();
          //Aquí retornan los datos al controlador
      return $query;
    }
/* End of file presupuesto_model.php */
/* Location: ./application/models/presupuesto_model.php */

 }
 
 