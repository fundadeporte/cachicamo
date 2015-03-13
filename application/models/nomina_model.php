<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nomina_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function todas($anio)
    {        
      //get all entry
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'nro_control',
            'cod_sede',
            'max(fecha_inicio) as desde',
            'max(fecha_fin) as hasta',
            'condicion_nomina',
            'count(cedula) as movimientos',
            'max(fecha_cierre) as cierre',
            'sum(monto_concepto) as monto',
            'sum(case when clase = 0 then monto_concepto else 0 end ) as retenciones',
            'sum(case when clase = 1 then monto_concepto else 0 end ) as pagos'
        );
        
        //$estatus = array(1,2);
        $integra->select($datos);
        $integra->from('movimientos');
        //$integra->where('cod_sede', $sede);
        //$integra->where_in('codigo_concepto', $estatus);
        $integra->group_by(array("nro_control", "cod_sede","condicion_nomina"));
        $integra->order_by("nro_control", "asc");
        $integra->where("year(nro_control)",$anio);
        $integra->order_by("cod_sede", "asc");
        
        $query = $integra->get()->result_array();
        return $query;
    } 
    function agrupar_nominas()
    {
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'year(nro_control) as anio',
            'month(nro_control) as mes',
            'sum(monto_concepto) as monto',
            'sum(case when clase = 0 then monto_concepto else 0 end ) as retenciones',
            'sum(case when clase = 1 then monto_concepto else 0 end ) as asignaciones',
            'count(cedula) as movimientos',
            'max(fecha_cierre) as ultimo_cierre'
            );
        $integra->select($datos);
        $integra->from('movimientos');
        $integra->group_by(array('year(nro_control)','month(nro_control)'));
        $integra->order_by('year(nro_control) desc , month(nro_control) desc');


        $datos = $integra->get()->result_array();
        return $datos;
    }

    function ver($anio, $mes)
    {
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'year(nro_control) as anio',
            'month(nro_control) as mes',
            'nro_control',
            'cod_sede',
            'sum(monto_concepto) as monto',
            'sum(case when clase = 0 then monto_concepto else 0 end ) as retenciones',
            'sum(case when clase = 1 then monto_concepto else 0 end ) as asignaciones',
            'count(cedula) as movimientos',
            'max(fecha_cierre) as ultimo_cierre',
            'condicion_nomina'
            );

        $integra->select($datos);
        $integra->from('movimientos');
        $integra->where("year(nro_control)",$anio);
        $integra->where("month(nro_control)",$mes);
        $integra->group_by(array('year(nro_control)','month(nro_control)','nro_control','cod_sede','condicion_nomina'));
        $integra->order_by('nro_control, year(nro_control) desc , month(nro_control) desc, cod_sede');


        $query = $integra->get()->result_array();
        return $query;
    }

    function caja_ahorro($anio, $mes, $nomina, $concepto)
    {
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'fecha_cierre as fecha',
            'cedula',
            'sum(monto_concepto) as monto',
            'ds_concepto'
            );
        $integra->select($datos);
        $integra->from('movimientos, conceptos');
        $integra->where("movimientos.cod_sede",$nomina);
        $integra->where("year(nro_control)",$anio);
        $integra->where("month(nro_control)",$mes);
        $integra->where("movimientos.cod_sede = conceptos.cod_sede");
        $integra->where("movimientos.codigo_concepto = conceptos.codigo_concepto");
        $integra->where_in('movimientos.codigo_concepto',$concepto);
        $integra->group_by(array('fecha_cierre','cedula', 'ds_concepto'));
        //$integra->order_by('nro_control, year(nro_control) desc , month(nro_control) desc, movimientos.cod_sede');
        
        $datos = $integra->get()->result_array();
        return $datos;
    }

    function formato_ocp($anio,$mes, $sede)
    {
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
                'datepart(week,nro_control) as semana',
                'max(nro_control) as quincena',
                'empleado.cod_sede',
                'empleado.cedula',
                "empleado.nombre_uno + ' ' + empleado.apellido_uno as nombre",
                'fecha_ingreso',
                'empleado.sueldo as sueldo',
                'cargo.cargo',
                "programa.desc_prog + '-' + desc_act as actividad",
                'SUM(CASE WHEN clase = 1 and codigo_concepto in (29,30) THEN monto_concepto ELSE 0 END) as basico',
                'SUM(CASE WHEN clase = 1 and codigo_concepto not in (29,30) THEN monto_concepto ELSE 0 END) as asignacion', 
                'SUM(CASE WHEN clase = 0 THEN monto_concepto ELSE 0 END) as deduccion',
                '(basico  + asignacion ) as integral'
            );
        $status = array(1,2);
        $integra->select($datos);
        $integra->from('empleado, cargo, programa, programa_actividad, movimientos');
        $integra->where_in("empleado.status_nomina", $status);
        $integra->where("empleado.codigo_cargo = cargo.codigo_cargo");
        $integra->where("empleado.cod_sede = cargo.cod_sede ");
        $integra->where("empleado.cod_institucion = cargo.cod_institucion ");
        $integra->where("empleado.cod_sede = programa.cod_sede ");
        $integra->where("empleado.cod_institucion = programa.cod_institucion ");
        $integra->where("empleado.programa = programa.cod_desc_prog ");
        $integra->where("cargo.cod_sede = programa.cod_sede ");
        $integra->where("cargo.cod_institucion = programa.cod_institucion ");
        $integra->where("empleado.cod_sede = programa_actividad.cod_sede ");
        $integra->where("empleado.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.cod_sede = programa_actividad.cod_sede ");
        $integra->where("empleado.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.programa = programa_actividad.cod_desc_prog ");
        $integra->where("programa.cod_sede = programa_actividad.cod_sede ");
        $integra->where("programa.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("programa.cod_sede = programa_actividad.cod_sede ");
        $integra->where("programa.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("programa.cod_desc_prog = programa_actividad.cod_desc_prog ");
        $integra->where("cargo.cod_sede = programa_actividad.cod_sede ");
        $integra->where("cargo.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.actividad = programa_actividad.cod_desc_act ");
        $integra->where("empleado.cod_sede = movimientos.cod_sede ");
        $integra->where("empleado.cedula = movimientos.cedula ");
        $integra->where("programa.cod_sede = movimientos.cod_sede ");
        $integra->where("year(movimientos.nro_control)", $anio );
        $integra->where("month(movimientos.nro_control)", $mes );
        $integra->where("empleado.cod_sede", $sede);
        $integra->group_by(array("semana","empleado.cod_sede", "empleado.cedula", "nombre", "fecha_ingreso", "empleado.sueldo", "cargo", "actividad"));
        $integra->order_by("semana,empleado.cod_sede, actividad, empleado.cedula");
        $datos = $integra->get()->result_array();
        return $datos;
    } 
        function formato_ocpo($anio,$mes)
    {
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
                'datepart(week,nro_control) as semana',
                'max(nro_control) as quincena',
                'empleado.cod_sede',
                'empleado.cedula',
                "empleado.nombre_uno + ' ' + empleado.apellido_uno as nombre",
                'fecha_ingreso',
                'empleado.sueldo as sueldo',
                'cargo.cargo',
                "programa.desc_prog + '-' + desc_act as actividad",
                'SUM(CASE WHEN clase = 1 and codigo_concepto in (2) THEN monto_concepto ELSE 0 END) as basico',
                'SUM(CASE WHEN clase = 1 and codigo_concepto not in (2) THEN monto_concepto ELSE 0 END) as asignacion', 
                'SUM(CASE WHEN clase = 0 THEN monto_concepto ELSE 0 END) as deduccion',
                '(basico  + asignacion ) as integral'
            );
        $status = array(1,2);
        $integra->select($datos);
        $integra->from('empleado, cargo, programa, programa_actividad, movimientos');
        $integra->where_in("empleado.status_nomina", $status);
        $integra->where("empleado.codigo_cargo = cargo.codigo_cargo");
        $integra->where("empleado.cod_sede = cargo.cod_sede ");
        $integra->where("empleado.cod_institucion = cargo.cod_institucion ");
        $integra->where("empleado.cod_sede = programa.cod_sede ");
        $integra->where("empleado.cod_institucion = programa.cod_institucion ");
        $integra->where("empleado.programa = programa.cod_desc_prog ");
        $integra->where("cargo.cod_sede = programa.cod_sede ");
        $integra->where("cargo.cod_institucion = programa.cod_institucion ");
        $integra->where("empleado.cod_sede = programa_actividad.cod_sede ");
        $integra->where("empleado.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.cod_sede = programa_actividad.cod_sede ");
        $integra->where("empleado.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.programa = programa_actividad.cod_desc_prog ");
        $integra->where("programa.cod_sede = programa_actividad.cod_sede ");
        $integra->where("programa.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("programa.cod_sede = programa_actividad.cod_sede ");
        $integra->where("programa.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("programa.cod_desc_prog = programa_actividad.cod_desc_prog ");
        $integra->where("cargo.cod_sede = programa_actividad.cod_sede ");
        $integra->where("cargo.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.actividad = programa_actividad.cod_desc_act ");
        $integra->where("empleado.cod_sede = movimientos.cod_sede ");
        $integra->where("empleado.cedula = movimientos.cedula ");
        $integra->where("programa.cod_sede = movimientos.cod_sede ");
        $integra->where("year(movimientos.nro_control)", $anio );
        $integra->where("month(movimientos.nro_control)", $mes );
        $integra->where("empleado.cod_sede = 2");
        $integra->group_by(array("semana","empleado.cod_sede", "empleado.cedula", "nombre", "fecha_ingreso", "empleado.sueldo", "cargo", "actividad"));
        $integra->order_by("semana,empleado.cod_sede, actividad, empleado.cedula");
        $datos = $integra->get()->result_array();
        return $datos;
    }   
    function formato_ocpa($anio,$mes)
    {
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
                'datepart(week,nro_control) as semana',
                'max(nro_control) as quincena',
                'empleado.cod_sede',
                'empleado.cedula',
                "empleado.nombre_uno + ' ' + empleado.apellido_uno as nombre",
                'fecha_ingreso',
                'empleado.sueldo as sueldo',
                'cargo.cargo',
                "programa.desc_prog + '-' + desc_act as actividad",
                'SUM(CASE WHEN clase = 1 and codigo_concepto in (29,30,179,180,2014,2013) THEN monto_concepto ELSE 0 END) as basico',
                'SUM(CASE WHEN clase = 1 and codigo_concepto not in (29,30,179,180,2014,2013) THEN monto_concepto ELSE 0 END) as asignacion', 
                'SUM(CASE WHEN clase = 0 THEN monto_concepto ELSE 0 END) as deduccion',
                '(basico  + asignacion ) as integral'
            );
        $status = array(1,2);
        $integra->select($datos);
        $integra->from('empleado, cargo, programa, programa_actividad, movimientos');
        $integra->where_in("empleado.status_nomina", $status);
        $integra->where("empleado.codigo_cargo = cargo.codigo_cargo");
        $integra->where("empleado.cod_sede = cargo.cod_sede ");
        $integra->where("empleado.cod_institucion = cargo.cod_institucion ");
        $integra->where("empleado.cod_sede = programa.cod_sede ");
        $integra->where("empleado.cod_institucion = programa.cod_institucion ");
        $integra->where("empleado.programa = programa.cod_desc_prog ");
        $integra->where("cargo.cod_sede = programa.cod_sede ");
        $integra->where("cargo.cod_institucion = programa.cod_institucion ");
        $integra->where("empleado.cod_sede = programa_actividad.cod_sede ");
        $integra->where("empleado.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.cod_sede = programa_actividad.cod_sede ");
        $integra->where("empleado.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.programa = programa_actividad.cod_desc_prog ");
        $integra->where("programa.cod_sede = programa_actividad.cod_sede ");
        $integra->where("programa.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("programa.cod_sede = programa_actividad.cod_sede ");
        $integra->where("programa.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("programa.cod_desc_prog = programa_actividad.cod_desc_prog ");
        $integra->where("cargo.cod_sede = programa_actividad.cod_sede ");
        $integra->where("cargo.cod_institucion = programa_actividad.cod_institucion ");
        $integra->where("empleado.actividad = programa_actividad.cod_desc_act ");
        $integra->where("empleado.cod_sede = movimientos.cod_sede ");
        $integra->where("empleado.cedula = movimientos.cedula ");
        $integra->where("programa.cod_sede = movimientos.cod_sede ");
        $integra->where("year(movimientos.nro_control)", $anio );
        $integra->where("month(movimientos.nro_control)", $mes );
        $integra->where("empleado.cod_sede = 5");
        $integra->group_by(array("semana","empleado.cod_sede", "empleado.cedula", "nombre", "fecha_ingreso", "empleado.sueldo", "cargo", "actividad"));
        $integra->order_by("semana,empleado.cod_sede, actividad, empleado.cedula");
        $datos = $integra->get()->result_array();
        return $datos;
    }
    function cabecera_nomina($nro_control, $sede){
        $integra =$this->load->database('integra', TRUE);
        $datos = array(
                "movimientos.cedula as cedula" ,
                "nombre_uno + ' ' + apellido_uno as empleado", 
                "empleado.sueldo",
                "count(*) as movimientos", 
                "departamento", 
                "cargo",
                "SUM(CASE WHEN movimientos.clase = 1 THEN monto_concepto ELSE 0 END) as asignacion",
                "SUM(CASE WHEN movimientos.clase = 0 THEN monto_concepto ELSE 0 END) as deduccion",
            );
        $integra->select($datos);
        $integra->from("movimientos, empleado, cargo, departamentos");
        $integra->where("nro_control",$nro_control);
        $integra->where("movimientos.cod_sede",  $sede);
        $integra->where("empleado.cod_sede = movimientos.cod_sede and empleado.cedula = movimientos.cedula and cargo.cod_sede = empleado.cod_sede and cargo.cod_sede = movimientos.cod_sede and cargo.codigo_cargo = empleado.codigo_cargo and departamentos.codigo_departamento = empleado.codigo_departamento and departamentos.cod_sede = empleado.cod_sede");     
        $integra->group_by(array("cedula", "empleado", "empleado.sueldo", "cargo", "departamento"));
        $integra->order_by("departamento, cedula");
        $datos = $integra->get()->result_array();
        return $datos;
    }
    function detalle_nomina($nro_control,$sede){
/*
select concepto, monto_concepto,
SUM(CASE WHEN movimientos.clase = 1 THEN monto_concepto ELSE 0 END) as asignacion,
SUM(CASE WHEN movimientos.clase = 0 THEN monto_concepto ELSE 0 END) as deduccion 
from movimientos, conceptos
where 
movimientos.cod_sede = conceptos.cod_sede and
movimientos.codigo_concepto = conceptos.codigo_concepto and
cedula = '15804415' and nro_control = '2015-02-28'
group by concepto, monto_concepto
*/
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
                "concepto",
                "monto_concepto",
                "SUM(CASE WHEN movimientos.clase = 1 THEN monto_concepto ELSE 0 END) as asignacion ",
                "SUM(CASE WHEN movimientos.clase = 0 THEN monto_concepto ELSE 0 END) as deduccion "
            );
        $integra->select($datos);
        $integra->from("movimientos, conceptos");
        $integra->where("nro_control", $nro_control );
        $integra->where("cedula", $sede);
        $integra->where("movimientos.cod_sede = conceptos.cod_sede");
        $integra->group_by(array( "concepto","monto_concepto"));
        $integra->order_by("concepto, monto_concepto");
        $datos = $integra->get()->result_array();
        return $datos;

        }

/*function constacia_empleados ()
{

$integra = $this->load->database('integra', TRUE);
        $datos = array(

           'empleado.apellido_uno',  
           'empleado.apellido_dos',   
           'empleado.nombre_uno',   
           'empleado.nombre_dos',   
           'empleado.cedula',   
           'cargo.cargo',   
           'empleado.fecha_ingreso',   
           'empleado.sueldo',   
           'movimientos.monto_concepto'  
        );

        $integra->select($datos);
        $integra->from ('empleado, movimientos, cargo');  
        $integra->where('movimientos.cod_institucion = empleado.cod_institucion');  
        $integra->where('movimientos.cod_sede = empleado.cod_sede');   
        $integra->where('movimientos.cedula = empleado.cedula');   
        $integra->where('movimientos.cod_institucion = cargo.cod_institucion');   
        $integra->where('empleado.cod_sede = cargo.cod_sede');   
        $integra->where('empleado.codigo_cargo = cargo.codigo_cargo');   
        $estatus = array(1,2);
        $integra->where_in('status_nomina', $estatus);
        $integra->where('empleado.cod_sede = 1');    
        $integra->where('movimientos.codigo_concepto = 230'); 
        $integra->where('movimientos.nro_control = 20150228');   
        $integra->order_by('empleado.cedula');

        return $datos;
    }
}
 
/* End of file nomina_model.php */
/* Location: ./application/models/nomna_model.php */