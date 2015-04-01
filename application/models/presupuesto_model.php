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
      $saacp->order_by(' modificacion.cod_ano , clase,fecha, modificacion . nro_modificacion ,tipo_de_documento . descripcion_documento');

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
			select 
				modificacion_partida.cod_programa as proyecto,modificacion_partida.cod_act_obra as accion_especifica, 
				substr(modificacion_partida.cod_cuenta,1,3) as part, 	substr(modificacion_partida.cod_cuenta,4,2) as gen,
				substr(modificacion_partida.cod_cuenta,6,2) as esp,		substr(modificacion_partida.cod_cuenta,8,2) as sub_esp,
				modificacion_partida.signo as signo, modificacion_partida.monto as monto, presupuesto.descripcion as denominacion,
				modificacion_partida.ordinal_presupuesto as ordinal
			from 
				modificacion_partida, presupuesto
			where
				modificacion_partida.cod_sector = presupuesto.cod_sector and
				modificacion_partida.cod_organismo = presupuesto.cod_organismo and
				modificacion_partida.cod_ano = presupuesto.cod_ano and
				modificacion_partida.cod_programa = presupuesto.cod_programa and
				modificacion_partida.cod_subprograma = presupuesto.cod_subprograma and
				modificacion_partida.cod_proyecto = presupuesto.cod_proyecto and
				modificacion_partida.cod_act_obra = presupuesto.cod_act_obra and
				modificacion_partida.cod_cuenta = presupuesto.cod_cuenta and
				modificacion_partida.ordinal_presupuesto = presupuesto.ordinal_presupuesto and
				modificacion_partida.cod_ano = 2014 and nro_modificacion = 11 and tipo_documento = 'MOCA'
			order by
				proyecto, accion_especifica,part,gen,esp,sub_esp,signo
        */
        $saacp = $this->load->database('saacp', TRUE);

        $datos = array(
                'modificacion_partida.cod_programa as proyecto','modificacion_partida.cod_act_obra as accion_especifica', 
				'substr(modificacion_partida.cod_cuenta,1,3) as part','substr(modificacion_partida.cod_cuenta,4,2) as gen',
				'substr(modificacion_partida.cod_cuenta,6,2) as esp','substr(modificacion_partida.cod_cuenta,8,2) as sub_esp',
				'modificacion_partida.signo as signo', 'modificacion_partida.monto as monto',
				'presupuesto.descripcion as denominacion', 'modificacion_partida.ordinal_presupuesto as ordinal'
				);
          
          $saacp->select($datos);
          $saacp->from('modificacion_partida, presupuesto');    
          $saacp->where('modificacion_partida.cod_sector = presupuesto.cod_sector');  
          $saacp->where('modificacion_partida.cod_organismo = presupuesto.cod_organismo');
          $saacp->where('modificacion_partida.cod_ano = presupuesto.cod_ano');
          $saacp->where('modificacion_partida.cod_programa = presupuesto.cod_programa');
          $saacp->where('modificacion_partida.cod_subprograma = presupuesto.cod_subprograma');
          $saacp->where('modificacion_partida.cod_proyecto = presupuesto.cod_proyecto');
          $saacp->where('modificacion_partida.cod_act_obra = presupuesto.cod_act_obra');
          $saacp->where('modificacion_partida.cod_cuenta = presupuesto.cod_cuenta');
          $saacp->where('modificacion_partida.ordinal_presupuesto = presupuesto.ordinal_presupuesto');
          $saacp->where('modificacion_partida.cod_ano', $anio);
          $saacp->where('modificacion_partida.nro_modificacion', $nro_modificacion);
          $saacp->where('modificacion_partida.tipo_documento',$tipo); 
          $saacp->order_by('signo,proyecto, accion_especifica,part,gen,esp,sub_esp');
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
	
	
	function arbol($anio,$nro_modificacion,$tipo)
	{
		/*
			select 
				modificacion_partida.cod_programa as proyecto,modificacion_partida.cod_act_obra as accion_especifica, 
				substr(modificacion_partida.cod_cuenta,1,3) as part, 	substr(modificacion_partida.cod_cuenta,4,2) as gen,
				substr(modificacion_partida.cod_cuenta,6,2) as esp,		substr(modificacion_partida.cod_cuenta,8,2) as sub_esp,
				modificacion_partida.signo as signo, modificacion_partida.monto as monto, presupuesto.descripcion as denominacion,
				modificacion_partida.ordinal_presupuesto as ordinal, cod_sub_programa as sub_programa
			from 
				modificacion_partida, presupuesto
			where
				modificacion_partida.cod_sector = presupuesto.cod_sector and
				modificacion_partida.cod_organismo = presupuesto.cod_organismo and
				modificacion_partida.cod_ano = presupuesto.cod_ano and
				modificacion_partida.cod_programa = presupuesto.cod_programa and
				modificacion_partida.cod_subprograma = presupuesto.cod_subprograma and
				modificacion_partida.cod_proyecto = presupuesto.cod_proyecto and
				modificacion_partida.cod_act_obra = presupuesto.cod_act_obra and
				modificacion_partida.cod_cuenta = presupuesto.cod_cuenta and
				modificacion_partida.ordinal_presupuesto = presupuesto.ordinal_presupuesto and
				modificacion_partida.cod_ano = 2014 and nro_modificacion = 11 and tipo_documento = 'MOCA'
			order by
				proyecto, accion_especifica,part,gen,esp,sub_esp,signo
        */
        $saacp = $this->load->database('saacp', TRUE);

        $datos = array(
                'modificacion_partida.cod_programa as proyecto','modificacion_partida.cod_act_obra as accion_especifica', 
				'substr(modificacion_partida.cod_cuenta,1,3) as part','substr(modificacion_partida.cod_cuenta,4,2) as gen',
				'substr(modificacion_partida.cod_cuenta,6,2) as esp','substr(modificacion_partida.cod_cuenta,8,2) as sub_esp',
				'modificacion_partida.signo as signo', 'modificacion_partida.monto as monto',
				'presupuesto.descripcion as denominacion', 'modificacion_partida.ordinal_presupuesto as ordinal',
				'modificacion_partida.cod_subprograma as sub_programa'
				);
          
          $saacp->select($datos);
          $saacp->from('modificacion_partida, presupuesto');    
          $saacp->where('modificacion_partida.cod_sector = presupuesto.cod_sector');  
          $saacp->where('modificacion_partida.cod_organismo = presupuesto.cod_organismo');
          $saacp->where('modificacion_partida.cod_ano = presupuesto.cod_ano');
          $saacp->where('modificacion_partida.cod_programa = presupuesto.cod_programa');
          $saacp->where('modificacion_partida.cod_subprograma = presupuesto.cod_subprograma');
          $saacp->where('modificacion_partida.cod_proyecto = presupuesto.cod_proyecto');
          $saacp->where('modificacion_partida.cod_act_obra = presupuesto.cod_act_obra');
          $saacp->where('modificacion_partida.cod_cuenta = presupuesto.cod_cuenta');
          $saacp->where('modificacion_partida.ordinal_presupuesto = presupuesto.ordinal_presupuesto');
          $saacp->where('modificacion_partida.cod_ano', $anio);
          $saacp->where('modificacion_partida.nro_modificacion', $nro_modificacion);
          $saacp->where('modificacion_partida.tipo_documento',$tipo); 
          $saacp->order_by('signo,proyecto, accion_especifica,part,gen,esp,sub_esp');
          //Aquí se ejecuta la consulta
            $query = $saacp->get()->result_array();
			
			$arbol = array();
			$padre = "";
			$hijo = "";
			$i = $j = 0;
			$monto = 0;
          //Aquí retornan los datos al controlador
			foreach ($query as $key => $detalle):
				if ($padre <> $detalle['signo'].$detalle['proyecto'].$detalle['accion_especifica']):
					$j=0;
					$j++;
					
					$padre = $detalle['signo'].$detalle['proyecto'].$detalle['accion_especifica'];
					$arbol[$padre] = array(
								'proyecto' =>$detalle['proyecto'],'accion_especifica' =>$detalle['accion_especifica'],'signo' => $detalle['signo'],
								'monto' => $detalle['monto'], 'denominacion' => $this->nombre_padre($anio,$detalle['proyecto'],$detalle['accion_especifica']),
								'part' => $detalle['part'],'gen' => $detalle['gen'], 'bisnietos' => $j,
								'hijo' => $this->descendiente($anio,$detalle['proyecto'],$detalle['accion_especifica'],$detalle['sub_programa'],$detalle['part'].'000000',$detalle['signo']),
								'nieto' => $this->descendiente($anio,$detalle['proyecto'],$detalle['accion_especifica'],$detalle['sub_programa'],$detalle['part'].$detalle['gen'].'0000',$detalle['signo']),
								'bisnieto' => array($j => array('part' => $detalle['part'],'gen' => $detalle['gen'],'esp' => $detalle['esp'],'sub_esp' => $detalle['sub_esp'],'ordinal' =>$detalle['ordinal'],'denominacion' => $detalle['denominacion'],'signo' => $detalle['signo'],'monto' => $detalle['monto'])));
					$arbol[$padre]['nieto']['monto'] = $detalle['monto'];
					$arbol[$padre]['hijo']['monto'] = $detalle['monto'];
					$i++;
				else:
					$j++;
					$arbol[$padre]['monto'] = $arbol[$padre]['monto'] + $detalle['monto'];
					$arbol[$padre]['nieto']['monto'] = $arbol[$padre]['nieto']['monto'] + $detalle['monto'];
					$arbol[$padre]['hijo']['monto'] = $arbol[$padre]['hijo']['monto'] + $detalle['monto'];
					$arbol[$padre]['bisnieto'][$j] = array('part' => $detalle['part'],'gen' => $detalle['gen'],'esp' => $detalle['esp'],'sub_esp' => $detalle['sub_esp'],'ordinal' =>$detalle['ordinal'],'denominacion' => $detalle['denominacion'],'signo' => $detalle['signo'],'monto' => $detalle['monto']);
					$arbol[$padre]['bisnietos'] = $j;
				endif;
				$i++;
			endforeach;

			return $arbol;
			//return $query;
			
	}
	
	function nombre_padre($anio,$proyecto,$accion_especifica)
	{
		/*
			select 
				descripcion 
				cod_subprograma as subprograma
			from 
				actividad_obra 
			where 
				cod_ano = 2014 and 
				cod_programa = 01 and 
				cod_act_obra = '003'
		*/
		$saacp = $this->load->database('saacp', TRUE);
		$datos = array(
			'descripcion as descripcion'
		);
		$saacp->select($datos);
        $saacp->from('actividad_obra');    
        $saacp->where('cod_ano',$anio);  
        $saacp->where('cod_programa',$proyecto);
        $saacp->where('cod_act_obra', $accion_especifica);
		$query = $saacp->get()->result_array();
		
		return $query[0]['descripcion'];
		
	}
	
	function descendiente ($anio,$proyecto,$accion_especifica,$sub_programa,$cuenta,$signo)
	{
		/*
			select 
				descripcion as descripcion 
			from 
				presupuesto 
			where 
				cod_ano = 2014 and cod_programa = 02 and cod_subprograma = 01 and cod_act_obra = 001 and cod_cuenta = 403000000
		*/
		$saacp = $this->load->database('saacp', TRUE);
		$datos = array(
			'descripcion as descripcion',
		);
		$saacp->select($datos);
        $saacp->from('presupuesto');    
        $saacp->where('cod_ano',$anio);  
        $saacp->where('cod_programa',$proyecto);
        $saacp->where('cod_act_obra', $accion_especifica);
		$saacp->where('cod_subprograma',$sub_programa);
		$saacp->where('cod_cuenta',$cuenta);
		$query = $saacp->get()->result_array();
		//print_r($query[0]);
		if ($query):
			$denominacion = $query[0]['descripcion'];
		else:
			$denominacion = "";
		endif;
		
		return array('part' => substr($cuenta,0,3),'gen' => substr($cuenta,3,2),'esp' => substr($cuenta,5,2),'sub_esp' => substr($cuenta,7,2),'denominacion' => $denominacion,'signo' =>$signo);
	}
	
/* End of file presupuesto_model.php */
/* Location: ./application/models/presupuesto_model.php */

 }
 
 