<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empleado_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function todos($sede)
    {        
      //get all entry
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'id',
            'cedula',
            'nombre_uno',
            'apellido_uno',
            'email',
            'datediff(year,fecha_nacimiento,getdate()) as por_cumplir',
            "CAST (TRUNCNUM (( DATEFORMAT(NOW(), 'yyyymmdd') - DATEFORMAT(fecha_nacimiento,'yyyymmdd') ) / 10000 , 0) as INTEGER)as edad",
            "fecha_nacimiento",
            "grado",
            "paso",
            "cod_sede"
        );
        
        $estatus = array(1,2);
        $integra->select($datos);
        $integra->from('empleado');
        $integra->where('cod_sede', $sede);
        $integra->where_in('status_nomina', $estatus);
        $integra->order_by("cod_sede", "asc");
        $integra->order_by("cedula", "asc");
        $query = $integra->get()->result_array();
        return $query;
    }

    function ver($id)
    {
        $integra = $this->load->database('integra', TRUE);
        //Ver el empleado
        
        $integra->where('id',$id);
        //$empleado = $this->db->get('empleado');
        $data = array();
        $data['empleado'] = $integra->get('empleado')->result_array();

        $datos = array(
            'cedula',
            'CED_FAMILIAR',
            'nombre',
            'datediff(year,fecha_nacimiento,getdate()) as por_cumplir',
            "CAST (TRUNCNUM (( DATEFORMAT(NOW(), 'yyyymmdd') - DATEFORMAT(FECHA_NAC,'yyyymmdd') ) / 10000 , 0) as INTEGER)as edad",
            "FECHA_NAC as fecha_nacimiento"
        );
        $integra->select($datos);

        $integra->from('carga_familiar');

        $integra->where('cedula',$data['empleado'][0]['CEDULA']);

        $integra->order_by("fecha_nacimiento", "asc");

        $data['carga_familiar'] = $integra->get()->result_array();
        
        return array('empleado' =>$data['empleado'],'carga_familiar' =>$data['carga_familiar']) ;
    }
    function lista()
    {

        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'id',
            'cedula', 
            'nombre_uno',
            'apellido_uno',
            'email',
            'grado',
            'paso',
            'fecha_nacimiento',
            "CAST (TRUNCNUM (( DATEFORMAT(NOW(), 'yyyymmdd') - DATEFORMAT(fecha_nacimiento,'yyyymmdd') ) / 10000 , 0) as INTEGER)as edad",
            "CAST (TRUNCNUM (( DATEFORMAT(NOW(), 'yyyymmdd') - DATEFORMAT(fecha_ingreso,'yyyymmdd') ) / 10000 , 0) as INTEGER)as antiguedad",
            'fecha_ingreso',
            ' titulo',
            'departamento',
            'empleado.cod_sede'
            );
        
        $integra->select($datos);
        $integra->from('empleado, titulo, departamentos');
        $integra->where('empleado.codigo_titulo = titulo.codigo_titulo' );
        $integra->where('empleado.codigo_departamento = departamentos.codigo_departamento');
        $integra->where('empleado.cod_sede = departamentos.cod_sede');
        $excluir = array(17031718, 17277710, 6828983);
        $estatus = array(1,2);
        $integra->where_not_in('cedula', $excluir);
        $integra->where_in('status_nomina', $estatus);
        $integra->order_by("empleado.cod_sede", "asc");
        $integra->order_by("departamento", "asc");
        $integra->order_by("cedula", "asc");
        $query = $integra->get()->result_array();
        //print_r($query);
        return $query;
    }

    function lista_sin()
    {

        $integra = $this->load->database('integra', TRUE);
        $datos = array(
            'id',
            'cedula', 
            'nombre_uno',
            'apellido_uno',
            'email',
            'grado',
            'paso',
            'fecha_nacimiento',
            "CAST (TRUNCNUM (( DATEFORMAT(NOW(), 'yyyymmdd') - DATEFORMAT(fecha_nacimiento,'yyyymmdd') ) / 10000 , 0) as INTEGER)as edad",
            "CAST (TRUNCNUM (( DATEFORMAT(NOW(), 'yyyymmdd') - DATEFORMAT(fecha_ingreso,'yyyymmdd') ) / 10000 , 0) as INTEGER)as antiguedad",
            'fecha_ingreso',
            'departamento'
            );
        
        $integra->select($datos);
        $integra->from('empleado, departamentos');
        $integra->where('empleado.cod_sede = departamentos.cod_sede');
        $integra->where('empleado.codigo_departamento = departamentos.codigo_departamento');
        $integra->where('empleado.codigo_titulo', NULL);
        $estatus = array(1,2);
        $integra->where_in('status_nomina', $estatus);
        $integra->order_by("cedula", "asc");
        $query = $integra->get()->result_array();
        //print_r($query);
        return $query;
    }

    function listado_cajaahorro()
    {
        /*
  SELECT "empleado"."nombre_uno",   
         "empleado"."nombre_dos",   
         "empleado"."apellido_uno",   
         "empleado"."apellido_dos",   
         "empleado"."cedula",   
         "empleado"."numero_cuenta",   
         "empleado"."tipo_cuenta",   
         "movimientos"."codigo_concepto",   
         "empleado"."cod_sede"  
    FROM "empleado",   
         "movimientos"  
   WHERE ( "movimientos"."cod_institucion" = "empleado"."cod_institucion" ) and  
         ( "movimientos"."cod_sede" = "empleado"."cod_sede" ) and  
         ( "movimientos"."cedula" = "empleado"."cedula" ) and  
         ( ( "empleado"."cod_sede" in ( 1,2,3,4,5 ) ) AND  
         ( "movimientos"."codigo_concepto" in ( 39,150 ) ) AND  
         ( "empleado"."status_nomina" in ( 1,2 ) ) AND  
         ( "movimientos"."nro_control" = '2015-03-15' ) )   
GROUP BY "empleado"."nombre_uno",   
         "empleado"."nombre_dos",   
         "empleado"."apellido_uno",   
         "empleado"."apellido_dos",   
         "empleado"."cedula",   
         "empleado"."numero_cuenta",   
         "movimientos"."codigo_concepto",   
         "empleado"."cod_sede",   
         "empleado"."tipo_cuenta"   

        */
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
                "empleado.nombre_uno as nombre",   
                "empleado.nombre_dos ",   
                "empleado.apellido_uno as apellido",   
                "empleado.apellido_dos",   
                "empleado.cedula",   
                "empleado.numero_cuenta",   
                "empleado.tipo_cuenta",   
                "movimientos.codigo_concepto",   
                "empleado.cod_sede"  
            );

        $integra->select($datos);
        $integra->from("empleado, movimientos");
        $integra->where( "movimientos.cod_institucion = empleado.cod_institucion" );
        $integra->where( "movimientos.cod_sede = empleado.cod_sede" );
        $integra->where( "movimientos.cedula = empleado.cedula" );
        $integra->where_in( "empleado.cod_sede", array( 1,2,3,4,5 ) );
        $integra->where_in( "movimientos.codigo_concepto", array( 39,150 ) );  
        $integra->where_in( "empleado.status_nomina" ,array( 1,2 ) );  
        $integra->where( "movimientos.nro_control = '2015-03-15'" );
        
        $integra->group_by(array("empleado.nombre_uno", "empleado.nombre_dos","empleado.apellido_uno",   
         "empleado.apellido_dos", "empleado.cedula", "empleado.numero_cuenta","movimientos.codigo_concepto",   
         "empleado.cod_sede", "empleado.tipo_cuenta" ));

        $datos = $integra->get()->result_array();
        return $datos;
  
 }

function cabecera_constacia($cedula)
{

   /*
   selet empleado.nombre_uno,   
         empleado.nombre_dos,   
         empleado.apellido_uno,   
         empleado.apellido_dos, 
         empleado.cedula,
         departamentos.departamento,   
         cargo.cargo,   
         empleado.sueldo     
    FROM empleado,   
         departamentos,   
         cargo  
   WHERE empleado.cod_institucion = departamentos.cod_institucion and  
         departamentos.cod_institucion = cargo.cod_institucion and  
         departamentos.cod_sede = empleado.cod_sede and  
         empleado.codigo_departamento = departamentos.codigo_departamento and  
         empleado.cod_sede = cargo.cod_sede and  
         departamentos.cod_sede = cargo.cod_sede and  
         empleado.codigo_cargo = cargo.codigo_cargo and   
         empleado.status_nomina in ( 1,2 )  and
         empleado.cedula = 15420192   
Order by departamentos.departamento
         */
 $integra = $this->load->database('integra', TRUE);
        $datos = array(

         'empleado.nombre_uno',   
         'empleado.nombre_dos',   
         'empleado.apellido_uno',   
         'empleado.apellido_dos', 
         'empleado.cedula',
         'departamentos.departamento',   
         'cargo.cargo',   
         'empleado.sueldo'
         );     

 $integra->select($datos);
        $integra->from("empleado, departamentos, cargo");
        $integra->where( "empleado.cod_institucion = departamentos.cod_institucion" );
        $integra->where( "departamentos.cod_institucion = cargo.cod_institucion " );
        $integra->where( 'empleado.cod_sede = cargo.cod_sede' );
        $integra->where( 'departamentos.cod_sede = cargo.cod_sede' );
        $integra->where('empleado.codigo_cargo = cargo.codigo_cargo');
        $integra->where_in( "empleado.status_nomina", array( 1,2 ) );
        $integra->where( 'empleado.cedula', $cedula );
        $integra->order_by('departamentos.departamento');

                 $datos = $integra->get()->result_array();
        return $datos;
       
   
    }
function constacia_egresado($cedula)
    {  
/*
select top 3 empleado.cedula, 
       nombre_uno, 
       apellido_uno, 
       fecha_ingreso, 
       fecha_egreso, 
       empleado.cod_sede, 
       cargo, 
       year(nro_control) as anio, month(nro_control)  as mes ,
sum(monto_concepto)*2 as ultimo_sueldo from empleado, cargo, movimientos
where
       cargo.codigo_cargo = empleado.codigo_cargo and
       empleado.cod_sede = cargo.cod_sede and
empleado.cod_sede = movimientos.cod_sede and
cargo.cod_sede = movimientos.cod_sede and
empleado.cedula = movimientos.cedula and
empleado.cedula  = '15419958' and empleado.fecha_egreso is not null 
and codigo_concepto in (29)
group by
empleado.cedula, nombre_uno, apellido_uno, fecha_ingreso, fecha_egreso, 
empleado.cod_sede, cargo, anio,  mes
order by anio desc, mes desc
*/

$integra = $this->load->database('integra', TRUE);
        $datos = array(
        'top 1 empleado.cedula', 
        "empleado.nombre_uno + ' ' + empleado.nombre_dos as nombres", 
        "empleado.apellido_uno + ' ' + empleado.apellido_dos as apellidos", 
        "DATEFORMAT(empleado.fecha_ingreso, 'dd/mm/yyyy') as fecha_ingreso", 
        "DATEFORMAT(empleado.fecha_egreso, 'dd/mm/yyyy') as fecha_egreso", 
        'empleado.cod_sede', 
        'cargo.cargo', 
        'year("nro_control") as anio', 
        'month("nro_control")  as mes',
        'monto_concepto *2 as ultimo_sueldo'
         );     

        $integra->select($datos);
        $integra->from("empleado, cargo, movimientos");
        $integra->where( "cargo.codigo_cargo = empleado.codigo_cargo" );
        $integra->where( "empleado.cod_sede = movimientos.cod_sede " );
        $integra->where( "cargo.cod_sede = movimientos.cod_sede" );
        $integra->where( "empleado.cedula = movimientos.cedula" );
        $integra->where("empleado.fecha_egreso is not null" );
        $integra->where( "codigo_concepto = 29");
        $integra->where( "empleado.cedula", $cedula );
        $integra->where( "empleado.status_nomina = 0" );
        $integra->group_by(array("empleado.cedula", "nombres", "apellidos", "fecha_ingreso", "fecha_egreso", 
        "empleado.cod_sede", "cargo", "anio",  "mes",'monto_concepto'));
        $integra->order_by("anio desc, mes desc");

        $datos = $integra->get()->result_array();
        return $datos;
    }

    function lista_egreados_anio()
    {
        /*select 
            year(fecha_egreso) as anio, 
            count(*) as egresados 
        from empleado where fecha_egreso is not null
            group by anio
            order by anio*/
        
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
           'year(fecha_egreso) as anio', 
            'count(*) as egresados' 
         );        
        $integra->select($datos);
        $integra->from("empleado");
        $integra->where("fecha_egreso is not null" );
        $integra->group_by("anio");
        $integra->order_by("anio desc");

        $datos = $integra->get()->result_array();
        return $datos;
    }

    function egresados_por_anio($anio)
    {
        /*
            select * from empleado where year(fecha_egreso) = 2008
        */
        $integra = $this->load->database('integra', TRUE);
        $datos = array(
           'cedula',
           'nombre_uno',
           'apellido_uno',
           'fecha_egreso',
           'sueldo',
           'cod_sede'
         );        
        $integra->select($datos);
        $integra->from("empleado");
        $integra->where("year(fecha_egreso) ", $anio );
        $integra->order_by("fecha_egreso,cedula desc");

        $datos = $integra->get()->result_array();
        return $datos;
    }
}
 
/* End of file empleado_model.php */
/* Location: ./application/models/empleado_model.php */