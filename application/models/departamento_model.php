<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Departamento_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    function todos($sede)
    {
        //get all entry
        $datos = array(
            'cod_sede',
            'codigo_departamento',
            'departamento'
        );
        $ignorar = array(13,27);
        $integra = $this->load->database('integra', TRUE);
        $integra->where_in('cod_sede', $sede);
        $integra->where_not_in('codigo_departamento', $ignorar);
        $integra->select($datos);
        $integra->from('departamentos');
        $integra->order_by("cod_sede", "asc");
        $integra->order_by("codigo_departamento", "asc");
        $integra->order_by("departamento", "asc");
        $query = $integra->get()->result_array();
        return $query;
    }

    function ver($id,$sede)
    {
            /*
            SELECT "departamentos"."cod_sede",   
                     "departamentos"."codigo_departamento",   
                     "empleado"."cedula",   
                     "empleado"."nombre_uno",   
                     "empleado"."apellido_uno",   
                     "empleado"."status_nomina"  
                FROM "empleado",   
                     "departamentos"  
               WHERE ( "empleado"."cod_institucion" = "departamentos"."cod_institucion" ) and  
                     ( "departamentos"."cod_sede" = "empleado"."cod_sede" ) and  
                     ( "empleado"."codigo_departamento" = "departamentos"."codigo_departamento" ) and  
                     ( ( "departamentos"."cod_sede" = 1 ) AND  
                     ( "departamentos"."codigo_departamento" = 15 ) AND  
                     ( "empleado"."status_nomina" in ( 1,2 ) ) )    

                */
            //Aqui cargo el departamento
            $datos = array(
                'cod_sede', 
                'codigo_departamento',
                'departamento'

            );
            $this->db->select($datos);
            $this->db->from('departamentos');
            $this->db->where('codigo_departamento',$id);
            $this->db->where('cod_sede',$sede);
            $data['departamento'] = $this->db->get()->result_array();

            //Aqui cargo los empleados
            $datos = array(
                'id',
                'cedula',
                'nombre_uno',
                'apellido_uno',
                'grado',
                'paso',
                'codigo_cargo',
                'sueldo'
            );

            $this->db->select($datos);
            $this->db->from('empleado');
            $this->db->where('codigo_departamento', $id);
            $estatus = array(1);
            $this->db->where('cod_sede',$sede);
            $this->db->where_in('status_nomina',$estatus);
            $this->db->order_by('cedula');
            $data['empleados'] = $this->db->get()->result_array();
            
            $datos = array(
                'id',
                'cedula',
                'nombre_uno',
                'apellido_uno',
                'grado',
                'paso',
                'codigo_cargo',
                'sueldo'
            );

            $this->db->select($datos);
            $this->db->from('empleado');
            $this->db->where('codigo_departamento', $id);
            $estatus = array(2);
            $this->db->where('cod_sede',$sede);
            $this->db->where_in('status_nomina',$estatus);
            $this->db->order_by('cedula');
            $data['empleados_vacaciones'] = $this->db->get()->result_array();
            //return $data;
            return array('departamento' =>$data['departamento'],'empleados' =>$data['empleados'],'empleados_vacaciones' =>$data['empleados_vacaciones']) ;
    }
 
}
 
/* End of file departamento_model.php */
/* Location: ./application/models/departamento_model.php */