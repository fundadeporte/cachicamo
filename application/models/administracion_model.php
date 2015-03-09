<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administracion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        $this->load->database('saacp', TRUE);
    }
 
    function ordenes_compra()
    {
      //get all entry
      //Consulta de reporte de modificacion presupuestaria Cabecera
      /*  
      select 
        cod_ano as año, 
        count(*) as ordenes, 
        sum(monto) as monto 
      from 
        orden_de_compra 
      group by cod_ano 
      order by cod_ano desc
      Fin de la consulta
      */
      //Convertir la consulta al formato codeigniter
      $saacp = $this->load->database('saacp', TRUE);

      $datos = array(
          'cod_ano as anio',   
          'count(*) as ordenes',   
          'sum(monto) as monto'
        );
      $saacp->select($datos);
      $saacp->from('orden_de_compra');
      $saacp->group_by('cod_ano');
      $saacp->order_by('cod_ano desc');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }

    function ordenes_servicio()
    {
/*
    select 
      cod_ano, count(*) as cantidad, sum(monto) as monto 
    from 
      orden_de_servicio
    group by cod_ano
    order by cod_ano desc
*/
    $saacp = $this->load->database('saacp', TRUE);
    $datos = array(
          'cod_ano as anio',
          'count(*) as ordenes', 
          'sum(monto) as monto '
        );
    $saacp->select($datos);
    $saacp->from('orden_de_servicio');
    $saacp->group_by('cod_ano');
    $saacp->order_by('cod_ano desc');

    //Fin de la conversión
    //Aquí se ejecuta la consulta
    $query = $saacp->get()->result_array();
    //Aquí retornan los datos al controlador
    return $query;
    }

    function ver_ordenes_compra_anio($anio)
    {
      /*
        select 
          orden_de_compra.nro_orden_compra as nro, 
          fecha_documento as fecha, 
          concepto_orden as concepto, 
          nombre_beneficiario as beneficiario, 
          detalle_orden_de_compra.cod_cuenta as partida_presupuestaria, 
          (cantidad * precio_unitario) as monto
        from 
          detalle_orden_de_compra, orden_de_compra, beneficiarios 
        where 
          detalle_orden_de_compra.nro_orden_compra = orden_de_compra.nro_orden_compra and
          detalle_orden_de_compra.cod_ano = orden_de_compra.cod_ano and
          detalle_orden_de_compra.cod_organismo = orden_de_compra.cod_organismo and
          beneficiarios.nro_rif_ced = orden_de_compra.nro_rif_ced and
          orden_de_compra.cod_ano in (2013)
        order by 
          detalle_orden_de_compra.nro_orden_compra, fecha_documento, item_oc
      */
      $saacp = $this->load->database('saacp', TRUE);
      $datos = array(
        'orden_de_compra.nro_orden_compra as nro', 
        'fecha_documento as fecha', 
        'concepto_orden as concepto', 
        'nombre_beneficiario as beneficiario', 
        'detalle_orden_de_compra.cod_cuenta as partida_presupuestaria', 
        'sum((cantidad * precio_unitario)) as monto'
      );
      $saacp->select($datos);
      $saacp->from('detalle_orden_de_compra, orden_de_compra, beneficiarios ');
      $saacp->where('detalle_orden_de_compra.nro_orden_compra = orden_de_compra.nro_orden_compra');
      $saacp->where('detalle_orden_de_compra.cod_ano = orden_de_compra.cod_ano');
      $saacp->where('detalle_orden_de_compra.cod_organismo = orden_de_compra.cod_organismo ');
      $saacp->where('beneficiarios.nro_rif_ced = orden_de_compra.nro_rif_ced');
      $saacp->where('orden_de_compra.cod_ano',$anio);
      $saacp->group_by(array('orden_de_compra.nro_orden_compra','fecha_documento','concepto','beneficiario','partida_presupuestaria'));
      $saacp->order_by('orden_de_compra.nro_orden_compra, fecha_documento, monto');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }
    
    function ver_orden_servicio_anio($anio)
    {
      /*
      select 
        detalle_orden_de_servicio.nro_orden_servicio as nro, 
        fecha_documento as fecha, 
        descripcion_os as concepto, 
        nombre_beneficiario as beneficiario,
        cod_cuenta as partida_presupuestaria, 
        sum((cantidad* detalle_orden_de_servicio.precio_unitario)) as monto
      from 
        detalle_orden_de_servicio, orden_de_servicio, beneficiarios
      where 
        detalle_orden_de_servicio.nro_orden_servicio = orden_de_servicio.nro_orden_servicio and
        detalle_orden_de_servicio.cod_ano = orden_de_servicio.cod_ano and
        beneficiarios.nro_rif_ced = orden_de_servicio.nro_rif_ced and
        detalle_orden_de_servicio.cod_ano = 2013
      group by 
        detalle_orden_de_servicio.nro_orden_servicio, fecha_documento, descripcion_os, nombre_beneficiario,cod_cuenta 
      order by 
        detalle_orden_de_servicio.nro_orden_servicio
      */
      $saacp = $this->load->database('saacp', TRUE);
      $datos = array(
        'detalle_orden_de_servicio.nro_orden_servicio as nro', 
        'fecha_documento as fecha', 
        'descripcion_os as concepto', 
        'nombre_beneficiario as beneficiario',
        'cod_cuenta as partida_presupuestaria', 
        'sum((cantidad* detalle_orden_de_servicio.precio_unitario)) as monto'
      );
      $saacp->select($datos);
      $saacp->from('detalle_orden_de_servicio, orden_de_servicio, beneficiarios');
      $saacp->where('detalle_orden_de_servicio.nro_orden_servicio = orden_de_servicio.nro_orden_servicio');
      $saacp->where('detalle_orden_de_servicio.cod_ano = orden_de_servicio.cod_ano ');
      $saacp->where('beneficiarios.nro_rif_ced = orden_de_servicio.nro_rif_ced ');
      $saacp->where('detalle_orden_de_servicio.cod_ano',$anio);
      $saacp->group_by(array('detalle_orden_de_servicio.nro_orden_servicio', 'fecha_documento', 'descripcion_os', 'nombre_beneficiario','cod_cuenta'));
      $saacp->order_by('detalle_orden_de_servicio.nro_orden_servicio, monto');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;

    }

    function contratos()
    {
      /*
      select 
        cod_ano as anio, 
        count(*) as cuantos, 
        sum(monto) as monto 
      from 
        contrato_de_obra 
      group by 
        cod_ano 
      order by 
        cod_ano desc
      */
      $saacp = $this->load->database('saacp', TRUE);
      $datos = array(
        'cod_ano as anio', 
        'count(*) as ordenes', 
        'sum(monto) as monto '
      );
      $saacp->select($datos);
      $saacp->from('contrato_de_obra ');
      $saacp->group_by(array('cod_ano'));
      $saacp->order_by('cod_ano desc');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }
    function ver_contratos_anio($anio)
    {
      /*
        SELECT 
          detalle_contrato_de_obra.nro_contrato_obra as nro, 
          fecha_documento as fecha, 
          concepto_contrato as concepto, 
          nombre_beneficiario as beneficiario, 
          cod_cuenta as partida_presupuestaria, 
          detalle_contrato_de_obra.monto as monto 
        FROM 
          detalle_contrato_de_obra, contrato_de_obra, beneficiarios 
        where 
          detalle_contrato_de_obra.nro_contrato_obra = contrato_de_obra.nro_contrato_obra and
          detalle_contrato_de_obra.cod_ano = contrato_de_obra.cod_ano and
          beneficiarios.nro_rif_ced = contrato_de_obra.nro_rif_ced and
          detalle_contrato_de_obra.cod_ano = 2013
      */
      $saacp = $this->load->database('saacp', TRUE);
      $datos = array(
          'detalle_contrato_de_obra.nro_contrato_obra as nro', 
          'fecha_documento as fecha', 
          'concepto_contrato as concepto', 
          'nombre_beneficiario as beneficiario', 
          'cod_cuenta as partida_presupuestaria', 
          'detalle_contrato_de_obra.monto as monto '
      );
      $saacp->select($datos);
      $saacp->from('detalle_contrato_de_obra, contrato_de_obra, beneficiarios ');
      $saacp->where('detalle_contrato_de_obra.nro_contrato_obra = contrato_de_obra.nro_contrato_obra');
      $saacp->where('detalle_contrato_de_obra.cod_ano = contrato_de_obra.cod_ano ');
      $saacp->where('beneficiarios.nro_rif_ced = contrato_de_obra.nro_rif_ced ');
      $saacp->where('detalle_contrato_de_obra.cod_ano', $anio);
      $saacp->order_by('nro, monto');

      //Fin de la conversión
      //Aquí se ejecuta la consulta
      $query = $saacp->get()->result_array();
      //Aquí retornan los datos al controlador
      return $query;
    }
/* End of file administracion_model.php */
/* Location: ./application/models/administracion_model.php */

 }
 
 