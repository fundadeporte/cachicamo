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
        $excluir = array(14382287, 7517267, 8837379, 17905881, 7457702, 12474871,3116442);
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
}
 
/* End of file empleado_model.php */
/* Location: ./application/models/empleado_model.php */